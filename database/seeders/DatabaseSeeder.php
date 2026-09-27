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
            ['email' => 'joshi.vijay700@gmail.com'],
            [
                'name' => 'Vijay Joshi',
                'phone' => '9033965711',
                'password' => Hash::make('vijayjoshi700'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Run CourseSeeder for courses
        $this->call(CourseSeeder::class);
    }
}
