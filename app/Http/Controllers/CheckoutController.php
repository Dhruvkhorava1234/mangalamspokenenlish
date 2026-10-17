<?php

namespace App\Http\Controllers;

use App\Mail\CoursePurchasedMail;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use App\Notifications\CoursePurchasedNotification;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function __construct(
        protected RazorpayService $razorpayService
    ) {}

    /**
     * Show Razorpay checkout page and dynamically create the Razorpay order.
     */
    public function show(Course $course)
    {
        $user = Auth::user();

        // If already enrolled or admin, redirect straight to viewer
        if ($user && $user->hasPurchased($course)) {
            return redirect()->route('student.courses.viewer', $course->slug)
                ->with('info', 'You already have active access to this course.');
        }

        try {
            // Dynamically create Razorpay Order for course current price
            $razorpayOrder = $this->razorpayService->createOrder($course, $user);
            $razorpayKeyId = $this->razorpayService->getKeyId();

            return view('checkout.razorpay', compact('course', 'razorpayOrder', 'razorpayKeyId'));
        } catch (\Exception $e) {
            Log::error('Razorpay Checkout Init Error: '.$e->getMessage());

            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Unable to initiate payment: '.$e->getMessage());
        }
    }

    /**
     * Verify Razorpay payment, create order and grant course access.
     * Supports AJAX JSON, standard form submit, and server callback post.
     */
    public function process(Request $request, Course $course)
    {
        $paymentId = (string) $request->input('razorpay_payment_id');
        $orderId = (string) $request->input('razorpay_order_id');
        $signature = (string) $request->input('razorpay_signature');

        if (empty($paymentId) || empty($signature)) {
            $errorMsg = 'Incomplete payment details received from payment gateway.';
            Log::error("Razorpay Process Error: Missing paymentId or signature for course {$course->id}");

            if ($request->expectsJson() || $request->isJson()) {
                return response()->json(['success' => false, 'message' => $errorMsg], 422);
            }

            return redirect()->route('checkout.show', $course->slug)->with('error', $errorMsg);
        }

        // Verify Razorpay payment (dual check: HMAC cryptographic signature + API fallback)
        $isValid = $this->razorpayService->verifyPayment($orderId, $paymentId, $signature);

        if (! $isValid) {
            Log::error("Razorpay Payment Verification Failed for Order: {$orderId}, Payment: {$paymentId}");
            $errorMsg = 'Payment verification failed. If money was deducted, please contact support with Payment ID: '.$paymentId;

            if ($request->expectsJson() || $request->isJson()) {
                return response()->json(['success' => false, 'message' => $errorMsg], 400);
            }

            return redirect()->route('checkout.show', $course->slug)->with('error', $errorMsg);
        }

        // Resolve authenticated user; if session was dropped during payment redirect, resolve from Razorpay notes
        $user = Auth::user();

        if (! $user) {
            $paymentInfo = $this->razorpayService->fetchPayment($paymentId);
            $userIdFromNotes = $paymentInfo['notes']['user_id'] ?? null;

            if ($userIdFromNotes) {
                $user = User::find($userIdFromNotes);
                if ($user) {
                    Auth::login($user);
                    Log::info("Re-authenticated user #{$user->id} from Razorpay payment notes.");
                }
            }
        }

        if (! $user) {
            Log::error("Cannot resolve student user for verified payment {$paymentId}");
            $errorMsg = 'Payment was verified, but user account could not be identified. Please log in and contact support.';

            if ($request->expectsJson() || $request->isJson()) {
                return response()->json(['success' => false, 'message' => $errorMsg], 401);
            }

            return redirect()->route('login')->with('error', $errorMsg);
        }

        // Idempotent Order Creation: Prevent duplicates if submitted multiple times
        $order = Order::firstOrCreate(
            ['transaction_id' => $paymentId],
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => $course->price,
                'payment_status' => 'paid',
                'payment_method' => 'razorpay',
                'expires_at' => now()->addYear(),
            ]
        );

        // Send In-App & Email Notifications to Admin(s)
        try {
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new CoursePurchasedNotification($order));
                Mail::to($admin->email)->send(new CoursePurchasedMail($order));
            }
        } catch (\Exception $e) {
            Log::error('Failed sending purchase notification: '.$e->getMessage());
        }

        $redirectUrl = route('student.courses.viewer', $course->slug);

        if ($request->expectsJson() || $request->isJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment verified successfully!',
                'redirect_url' => $redirectUrl,
            ]);
        }

        return redirect()->route('student.courses.viewer', $course->slug)
            ->with('success', 'Payment successful with Razorpay! You have unlocked full access to '.$course->title);
    }
}
