<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function __construct(
        protected RazorpayService $razorpayService
    ) {}

    /**
     * Display admin overview stats and recent sales.
     */
    public function index()
    {
        $totalRevenue = Order::where('payment_status', 'paid')->sum('amount');
        $totalStudents = User::where('role', 'student')->count();
        $totalCourses = Course::count();
        $totalPurchases = Order::where('payment_status', 'paid')->count();

        $recentSales = Order::with(['user', 'course'])
            ->where('payment_status', 'paid')
            ->latest()
            ->take(10)
            ->get();

        $notifications = Auth::user()->notifications()->take(10)->get();
        $allCourses = Course::all();
        $allStudents = User::where('role', 'student')->orderBy('name')->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalStudents',
            'totalCourses',
            'totalPurchases',
            'recentSales',
            'notifications',
            'allCourses',
            'allStudents'
        ));
    }

    /**
     * Mark all notifications as read.
     */
    public function markNotificationsAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'Notifications marked as read.');
    }

    /**
     * Manually sync any Razorpay payment by Payment ID and grant course access.
     */
    public function syncPayment(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string',
            'course_id' => 'nullable|exists:courses,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $paymentId = trim($request->input('payment_id'));

        // Check if order already exists for this payment ID
        $existingOrder = Order::where('transaction_id', $paymentId)->first();
        if ($existingOrder) {
            return redirect()->back()->with('info', "Payment {$paymentId} is already recorded in the database for order #{$existingOrder->id}.");
        }

        // Fetch payment details directly from Razorpay API
        $paymentData = $this->razorpayService->fetchPayment($paymentId);
        if (! $paymentData) {
            return redirect()->back()->with('error', "Could not find payment {$paymentId} on Razorpay. Please verify the Payment ID in your Razorpay dashboard.");
        }

        $status = $paymentData['status'] ?? '';
        if ($status === 'authorized') {
            $this->razorpayService->capturePayment($paymentId, (int) ($paymentData['amount'] ?? 0));
            $paymentData = $this->razorpayService->fetchPayment($paymentId);
            $status = $paymentData['status'] ?? '';
        }

        if (! in_array($status, ['captured', 'paid', 'authorized'])) {
            return redirect()->back()->with('error', "Payment {$paymentId} has status '{$status}' on Razorpay (not captured).");
        }

        // Resolve Course
        $courseId = $request->input('course_id') ?: ($paymentData['notes']['course_id'] ?? null);
        $course = $courseId ? Course::find($courseId) : Course::first();

        if (! $course) {
            return redirect()->back()->with('error', 'No course found to link with this payment.');
        }

        // Resolve User
        $userId = $request->input('user_id') ?: ($paymentData['notes']['user_id'] ?? null);
        $user = $userId ? User::find($userId) : null;

        if (! $user && ! empty($paymentData['email'])) {
            $user = User::where('email', $paymentData['email'])->first();
        }

        if (! $user) {
            return redirect()->back()->with('error', 'Could not identify the student user from payment details. Please select the student from the dropdown.');
        }

        $amount = isset($paymentData['amount']) ? ((float) $paymentData['amount']) / 100 : (float) $course->price;

        $order = Order::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => $amount,
            'payment_status' => 'paid',
            'transaction_id' => $paymentId,
            'payment_method' => 'razorpay',
            'expires_at' => now()->addYear(),
        ]);

        Log::info("Admin manually synced Razorpay Payment {$paymentId} for Order #{$order->id}");

        return redirect()->back()->with('success', "Payment {$paymentId} synced successfully! User '{$user->name}' ({$user->email}) now has full access to '{$course->title}'.");
    }
}
