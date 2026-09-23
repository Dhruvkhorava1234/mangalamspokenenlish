<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display student's enrolled courses and order history.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch enrolled courses via paid orders
        $orders = Order::with(['course.images'])
            ->where('user_id', $user->id)
            ->where('payment_status', 'paid')
            ->latest()
            ->get();

        return view('student.dashboard', compact('orders'));
    }
}
