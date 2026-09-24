<?php

use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicCourseController;
use App\Http\Controllers\Student\CourseViewerController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Marketing Pages
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/courses', [PublicCourseController::class, 'index'])->name('courses');
Route::get('/courses/{slug}', [PublicCourseController::class, 'show'])->name('courses.show');

Route::get('/study-material', function () {
    return view('study-material');
})->name('study-material');

Route::get('/testimonials', function () {
    return view('testimonials');
})->name('testimonials');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

/*
|--------------------------------------------------------------------------
| Universal Dashboard Redirect (Fallback)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Student Portal & Checkout (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Student Dashboard
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

    // Interactive Image-based Course Viewer
    Route::get('/learn/{course:slug}', [CourseViewerController::class, 'show'])->name('student.courses.viewer');

    // Razorpay Checkout
    Route::get('/checkout/{course:slug}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{course:slug}', [CheckoutController::class, 'process'])->name('checkout.process');

    // Breeze Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin / Owner Portal (Role: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/notifications/mark-read', [AdminDashboardController::class, 'markNotificationsAsRead'])->name('notifications.markRead');

    // Course Management CRUD
    Route::resource('courses', AdminCourseController::class);
    Route::delete('courses/{course}/images/{image}', [AdminCourseController::class, 'destroyImage'])->name('courses.images.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| 404 Fallback Route
|--------------------------------------------------------------------------
| Catches any unrecognized URL and renders our custom branded 404 error page.
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
