<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicCourseController extends Controller
{
    /**
     * Display the public course catalog.
     */
    public function index()
    {
        $courses = Course::published()->withCount('images')->latest()->get();
        $purchasedCourseIds = [];
        if (Auth::check()) {
            if (Auth::user()->isAdmin()) {
                $purchasedCourseIds = $courses->pluck('id')->toArray();
            } else {
                $purchasedCourseIds = Auth::user()->orders()
                    ->where('payment_status', 'paid')
                    ->where(function ($query) {
                        $query->whereNull('expires_at')
                              ->where('created_at', '>=', now()->subYear())
                              ->orWhere('expires_at', '>', now());
                    })
                    ->pluck('course_id')
                    ->toArray();
            }
        }
        return view('courses', compact('courses', 'purchasedCourseIds'));
    }

    /**
     * Display course details preview & access gate.
     */
    public function show(string $slug)
    {
        $course = Course::where('slug', $slug)->with('images')->firstOrFail();
        
        $hasPurchased = false;
        if (Auth::check()) {
            $hasPurchased = Auth::user()->hasPurchased($course);
        }

        return view('courses.show', compact('course', 'hasPurchased'));
    }
}
