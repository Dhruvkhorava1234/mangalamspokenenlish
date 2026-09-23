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
    protected RazorpayService $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    /**
     * Show Razorpay checkout page and dynamically create the Razorpay order.
     */
    public function show(Course $course)
    {
        $user = Auth::user();

        // If already enrolled or admin, redirect straight to viewer
        if ($user->hasPurchased($course)) {
            return redirect()->route('student.courses.viewer', $course->slug)
                ->with('info', 'You already have active access to this course.');
        }

        try {
            // Dynamically create Razorpay Order for course current price
            $razorpayOrder = $this->razorpayService->createOrder($course, $user);
            $razorpayKeyId = $this->razorpayService->getKeyId();

            return view('checkout.razorpay', compact('course', 'razorpayOrder', 'razorpayKeyId'));
        } catch (\Exception $e) {
            Log::error('Razorpay Checkout Init Error: ' . $e->getMessage());
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Unable to initiate payment: ' . $e->getMessage());
        }
    }

    /**
     * Verify Razorpay payment signature, create order and grant course access.
     */
    public function process(Request $request, Course $course)
    {
        $user = Auth::user();

        // Check again if already purchased
        if ($user->hasPurchased($course)) {
            return redirect()->route('student.courses.viewer', $course->slug)
                ->with('info', 'You are already enrolled in this course.');
        }

        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
        ]);

        $paymentId = $request->input('razorpay_payment_id');
        $orderId   = $request->input('razorpay_order_id');
        $signature = $request->input('razorpay_signature');

        // Verify Razorpay cryptographic signature
        $isValidSignature = $this->razorpayService->verifyPaymentSignature($orderId, $paymentId, $signature);

        if (! $isValidSignature) {
            Log::error("Razorpay Signature Verification Failed for Order: {$orderId}, Payment: {$paymentId}");
            return redirect()->route('checkout.show', $course->slug)
                ->with('error', 'Payment verification failed. Invalid signature. Please contact support if money was deducted.');
        }

        // Prevent duplicate order if user submits multiple times
        $existingOrder = Order::where('transaction_id', $paymentId)->first();
        if ($existingOrder) {
            return redirect()->route('student.courses.viewer', $course->slug)
                ->with('info', 'Payment has already been processed for this transaction.');
        }

        // Create Order in database with course dynamic price and 1 year validity
        $order = Order::create([
            'user_id'        => $user->id,
            'course_id'      => $course->id,
            'amount'         => $course->price,
            'payment_status' => 'paid',
            'transaction_id' => $paymentId,
            'payment_method' => 'razorpay',
            'expires_at'     => now()->addYear(),
        ]);

        // Send In-App & Email Notifications to Admin(s)
        try {
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                // In-app database notification
                $admin->notify(new CoursePurchasedNotification($order));

                // Email notification (logs per MAIL_MAILER=log)
                Mail::to($admin->email)->send(new CoursePurchasedMail($order));
            }
        } catch (\Exception $e) {
            Log::error('Failed sending purchase notification: ' . $e->getMessage());
        }

        return redirect()->route('student.courses.viewer', $course->slug)
            ->with('success', 'Payment successful with Razorpay! You have unlocked full access to ' . $course->title);
    }
}
