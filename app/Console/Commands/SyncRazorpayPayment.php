<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use App\Services\RazorpayService;
use Illuminate\Console\Command;

class SyncRazorpayPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'razorpay:sync 
                            {payment_id : The Razorpay payment ID (e.g. pay_xxxxxxxxxx)} 
                            {--course= : Optional course ID} 
                            {--user= : Optional user ID or email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync a payment directly from Razorpay API, create the database order, and unlock the course';

    /**
     * Execute the console command.
     */
    public function handle(RazorpayService $razorpayService): int
    {
        $paymentId = trim((string) $this->argument('payment_id'));
        $this->info("Fetching payment details for: {$paymentId} from Razorpay...");

        $existing = Order::where('transaction_id', $paymentId)->first();
        if ($existing) {
            $this->warn("Payment {$paymentId} already exists in database as Order #{$existing->id}.");

            return self::SUCCESS;
        }

        $payment = $razorpayService->fetchPayment($paymentId);
        if (! $payment) {
            $this->error("Failed to retrieve payment {$paymentId} from Razorpay. Check your API keys in .env and the Payment ID.");

            return self::FAILURE;
        }

        $status = $payment['status'] ?? 'unknown';
        $this->info("Payment status on Razorpay: {$status}");

        if ($status === 'authorized') {
            $this->info('Payment is authorized. Capturing payment on Razorpay...');
            $captured = $razorpayService->capturePayment($paymentId, (int) ($payment['amount'] ?? 0));
            if ($captured) {
                $status = 'captured';
            }
        }

        if (! in_array($status, ['captured', 'paid', 'authorized'])) {
            $this->error("Payment status is '{$status}', which is not a completed payment.");

            return self::FAILURE;
        }

        // Resolve Course
        $courseId = $this->option('course') ?: ($payment['notes']['course_id'] ?? null);
        $course = $courseId ? Course::find($courseId) : Course::first();

        if (! $course) {
            $this->error('No course found in database.');

            return self::FAILURE;
        }

        // Resolve User
        $userOption = $this->option('user');
        $user = null;
        if ($userOption) {
            $user = is_numeric($userOption) ? User::find($userOption) : User::where('email', $userOption)->first();
        }

        if (! $user) {
            $userIdFromNotes = $payment['notes']['user_id'] ?? null;
            if ($userIdFromNotes) {
                $user = User::find($userIdFromNotes);
            }
        }

        if (! $user && ! empty($payment['email'])) {
            $user = User::where('email', $payment['email'])->first();
        }

        if (! $user) {
            $user = User::where('role', 'student')->first() ?: User::first();
            $this->warn("Could not auto-detect student from payment notes. Linked to: {$user->email}");
        }

        $amount = isset($payment['amount']) ? ((float) $payment['amount']) / 100 : (float) $course->price;

        $order = Order::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => $amount,
            'payment_status' => 'paid',
            'transaction_id' => $paymentId,
            'payment_method' => 'razorpay',
            'expires_at' => now()->addYear(),
        ]);

        $this->info('==========================================');
        $this->info("SUCCESS! Order #{$order->id} created successfully.");
        $this->info("Student: {$user->name} ({$user->email})");
        $this->info("Course: {$course->title} (ID: {$course->id})");
        $this->info('Amount: ₹'.number_format($amount, 2));
        $this->info('Status: Active (1 year access granted)');
        $this->info('==========================================');

        return self::SUCCESS;
    }
}
