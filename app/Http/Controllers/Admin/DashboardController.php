<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
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

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalStudents',
            'totalCourses',
            'totalPurchases',
            'recentSales',
            'notifications'
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
}
