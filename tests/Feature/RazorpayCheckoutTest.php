<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use App\Services\RazorpayService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Tests\TestCase;

class RazorpayCheckoutTest extends TestCase
{
    use RefreshDatabase;

    protected function createCourse(array $overrides = []): Course
    {
        return Course::create(array_merge([
            'title' => 'Spoken English Pro',
            'slug' => 'spoken-english-pro-'.uniqid(),
            'description' => 'Test course description',
            'price' => 499.00,
            'status' => 'published',
            'level' => 'Beginner',
            'duration' => '30 Days',
        ], $overrides));
    }

    public function test_checkout_show_renders_checkout_page_without_redirect_loop(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $course = $this->createCourse(['slug' => 'english-grammar-course']);

        $this->mock(RazorpayService::class, function (MockInterface $mock) {
            $mock->shouldReceive('createOrder')->once()->andReturn([
                'id' => 'order_123',
                'amount' => 49900,
                'currency' => 'INR',
            ]);
            $mock->shouldReceive('getKeyId')->once()->andReturn('rzp_test_123');
        });

        $response = $this->actingAs($user)->get(route('checkout.show', $course->slug));

        $response->assertOk();
        $response->assertViewIs('checkout.razorpay');
    }

    public function test_checkout_process_verifies_payment_and_creates_order(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $course = $this->createCourse(['slug' => 'spoken-english-pro']);

        $this->mock(RazorpayService::class, function (MockInterface $mock) {
            $mock->shouldReceive('verifyPayment')
                ->once()
                ->with('order_test123', 'pay_test456', 'valid_signature')
                ->andReturn(true);
        });

        $response = $this->actingAs($user)->post(route('checkout.process', $course->slug), [
            'razorpay_payment_id' => 'pay_test456',
            'razorpay_order_id' => 'order_test123',
            'razorpay_signature' => 'valid_signature',
        ]);

        $response->assertRedirect(route('student.courses.viewer', $course->slug));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'transaction_id' => 'pay_test456',
            'payment_status' => 'paid',
            'payment_method' => 'razorpay',
        ]);

        $this->assertTrue($user->fresh()->hasPurchased($course));
    }

    public function test_checkout_process_supports_ajax_json_response(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $course = $this->createCourse(['slug' => 'spoken-english-pro-ajax']);

        $this->mock(RazorpayService::class, function (MockInterface $mock) {
            $mock->shouldReceive('verifyPayment')
                ->once()
                ->andReturn(true);
        });

        $response = $this->actingAs($user)->postJson(route('checkout.process', $course->slug), [
            'razorpay_payment_id' => 'pay_ajax999',
            'razorpay_order_id' => 'order_ajax999',
            'razorpay_signature' => 'valid_sig',
        ]);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
            'redirect_url' => route('student.courses.viewer', $course->slug),
        ]);

        $this->assertDatabaseHas('orders', [
            'transaction_id' => 'pay_ajax999',
            'payment_status' => 'paid',
        ]);
    }

    public function test_razorpay_webhook_creates_order_for_captured_payment(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $course = $this->createCourse(['slug' => 'grammar-mastery']);

        $this->mock(RazorpayService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getWebhookSecret')->andReturn('');
        });

        $webhookPayload = [
            'event' => 'payment.captured',
            'payload' => [
                'payment' => [
                    'entity' => [
                        'id' => 'pay_webhook_123',
                        'order_id' => 'order_webhook_123',
                        'amount' => 29900,
                        'notes' => [
                            'course_id' => (string) $course->id,
                            'user_id' => (string) $user->id,
                        ],
                    ],
                ],
            ],
        ];

        $response = $this->postJson(route('razorpay.webhook'), $webhookPayload);

        $response->assertOk();
        $response->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'transaction_id' => 'pay_webhook_123',
            'payment_status' => 'paid',
        ]);

        $this->assertTrue($user->fresh()->hasPurchased($course));
    }

    public function test_order_creation_is_idempotent(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $course = $this->createCourse(['slug' => 'test-idempotent-course']);

        $this->mock(RazorpayService::class, function (MockInterface $mock) {
            $mock->shouldReceive('verifyPayment')->twice()->andReturn(true);
        });

        // Submit first time
        $this->actingAs($user)->post(route('checkout.process', $course->slug), [
            'razorpay_payment_id' => 'pay_duplicate_check',
            'razorpay_order_id' => 'order_dup',
            'razorpay_signature' => 'sig_dup',
        ]);

        // Submit second time with same payment ID
        $this->actingAs($user)->post(route('checkout.process', $course->slug), [
            'razorpay_payment_id' => 'pay_duplicate_check',
            'razorpay_order_id' => 'order_dup',
            'razorpay_signature' => 'sig_dup',
        ]);

        // There must be exactly 1 order in database
        $this->assertEquals(1, Order::where('transaction_id', 'pay_duplicate_check')->count());
    }
}
