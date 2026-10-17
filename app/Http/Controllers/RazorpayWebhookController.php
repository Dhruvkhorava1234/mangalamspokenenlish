<?php

namespace App\Http\Controllers;

use App\Mail\CoursePurchasedMail;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use App\Notifications\CoursePurchasedNotification;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RazorpayWebhookController extends Controller
{
    public function __construct(
        protected RazorpayService $razorpayService
    ) {}

    /**
     * Handle incoming webhook requests from Razorpay.
     */
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');

        Log::info('Razorpay Webhook received event.');

        // Verify webhook signature if webhook secret is configured
        $webhookSecret = $this->razorpayService->getWebhookSecret();
        if (! empty($webhookSecret)) {
            if (! $signature || ! $this->razorpayService->verifyWebhookSignature($payload, $signature)) {
                Log::error('Razorpay Webhook Signature Verification Failed.');

                return response()->json(['error' => 'Invalid signature'], 400);
            }
        }

        $data = json_decode($payload, true);
        if (! $data) {
            return response()->json(['error' => 'Invalid JSON payload'], 400);
        }

        $event = $data['event'] ?? '';
        Log::info("Razorpay Webhook Event: {$event}");

        // Only process paid / captured events
        if (! in_array($event, ['payment.captured', 'order.paid'])) {
            return response()->json(['status' => 'ignored'], 200);
        }

        $payment = $data['payload']['payment']['entity'] ?? null;
        $order = $data['payload']['order']['entity'] ?? null;

        $paymentId = $payment['id'] ?? null;
        if (! $paymentId) {
            return response()->json(['status' => 'missing_payment_id'], 200);
        }

        // Get notes from payment entity or order entity
        $notes = $payment['notes'] ?? ($order['notes'] ?? []);
        $courseId = $notes['course_id'] ?? null;
        $userId = $notes['user_id'] ?? null;

        // Fallback: If not in webhook payload notes, fetch payment directly from Razorpay API
        if (! $courseId || ! $userId) {
            $fetched = $this->razorpayService->fetchPayment($paymentId);
            if ($fetched) {
                $courseId = $courseId ?: ($fetched['notes']['course_id'] ?? null);
                $userId = $userId ?: ($fetched['notes']['user_id'] ?? null);
            }
        }

        if (! $courseId || ! $userId) {
            Log::warning("Razorpay Webhook: Could not find course_id or user_id for payment {$paymentId}");

            return response()->json(['status' => 'missing_notes'], 200);
        }

        $user = User::find($userId);
        $course = Course::find($courseId);

        if (! $user || ! $course) {
            Log::error("Razorpay Webhook: User #{$userId} or Course #{$courseId} not found in database.");

            return response()->json(['status' => 'entities_not_found'], 200);
        }

        $amount = isset($payment['amount']) ? ((float) $payment['amount']) / 100 : (float) $course->price;

        // Idempotently create the order
        $orderModel = Order::firstOrCreate(
            ['transaction_id' => $paymentId],
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => $amount,
                'payment_status' => 'paid',
                'payment_method' => 'razorpay',
                'expires_at' => now()->addYear(),
            ]
        );

        Log::info("Razorpay Webhook: Successfully processed order #{$orderModel->id} for user #{$user->id} and course #{$course->id}");

        // Send notifications to Admin
        try {
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new CoursePurchasedNotification($orderModel));
                Mail::to($admin->email)->send(new CoursePurchasedMail($orderModel));
            }
        } catch (\Exception $e) {
            Log::error('Razorpay Webhook: Notification failed: '.$e->getMessage());
        }

        return response()->json(['status' => 'success'], 200);
    }
}
