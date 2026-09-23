<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseViewerController extends Controller
{
    /**
     * Display the full interactive image-based course viewer.
     */
    public function show(Course $course)
    {
        $user = Auth::user();

        // Access gate: Must be admin or have paid enrollment
        if (! $user->hasPurchased($course)) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'This course is locked. Please complete enrollment to access learning slides.');
        }

        $course->load(['images' => function ($query) {
            $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
        }]);

        return view('student.courses.viewer', compact('course'));
    }
}
