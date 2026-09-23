<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Vijay Joshi (Admin)',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Create Test Student User
        $student = User::firstOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'Meet Patel',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ]
        );

        // 3. Run CourseSeeder for 5 image-based courses
        $this->call(CourseSeeder::class);

        // 4. Enroll the test student into Course 1 (Basic English Course) as an initial purchase demo
        $firstCourse = Course::where('slug', 'basic-english-course')->first();
        if ($firstCourse) {
            Order::create([
                'user_id' => $student->id,
                'course_id' => $firstCourse->id,
                'amount' => $firstCourse->price,
                'payment_status' => 'paid',
                'transaction_id' => 'pay_demo_' . strtolower(Str::random(18)),
                'payment_method' => 'razorpay',
            ]);
        }
    }
}
