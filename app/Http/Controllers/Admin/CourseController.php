<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /** Display a listing of all courses. */
    public function index()
    {
        $courses = Course::withCount(['images', 'paidOrders'])->latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    /** Show the form for creating a new course. */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created course.
     * The uploaded thumbnail is also saved as the first slide image so students can view it.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'status'      => 'required|in:published,draft',
            'level'       => 'nullable|string|max:100',
            'duration'    => 'nullable|string|max:100',
            'thumbnail'   => 'nullable|image|max:20480',
            'images.*'    => 'nullable|image|max:20480',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
            $pubDest = public_path('storage/' . $thumbnailPath);
            if (!file_exists($pubDest)) {
                @mkdir(dirname($pubDest), 0755, true);
                @copy(storage_path('app/public/' . $thumbnailPath), $pubDest);
            }
        }

        $course = Course::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . rand(100, 999),
            'description' => $request->description,
            'price'       => $request->price,
            'status'      => $request->status,
            'level'       => $request->level ?? 'All Levels',
            'duration'    => $request->duration ?? 'Self Paced',
            'thumbnail'   => $thumbnailPath,
        ]);

        $order = 1;

        // If a thumbnail was uploaded, also add it as first slide
        if ($thumbnailPath) {
            CourseImage::create([
                'course_id'  => $course->id,
                'image_path' => $thumbnailPath,
                'sort_order' => $order++,
                'caption'    => $course->title,
            ]);
        }

        // Additional slide images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePath = $file->store('courses/slides', 'public');
                $pubDest = public_path('storage/' . $imagePath);
                if (!file_exists($pubDest)) {
                    @mkdir(dirname($pubDest), 0755, true);
                    @copy(storage_path('app/public/' . $imagePath), $pubDest);
                }
                CourseImage::create([
                    'course_id'  => $course->id,
                    'image_path' => $imagePath,
                    'sort_order' => $order++,
                    'caption'    => 'Slide ' . ($order - 1),
                ]);
            }
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
    }

    /** Show the edit form for a course. */
    public function edit(Course $course)
    {
        $course->load(['images' => fn ($q) => $q->orderBy('sort_order')->orderBy('id')]);
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update course details and append new images.
     * Each uploaded image is saved as a CourseImage so students can view them.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'status'      => 'required|in:published,draft',
            'level'       => 'nullable|string|max:100',
            'duration'    => 'nullable|string|max:100',
            'images.*'    => 'nullable|image|max:20480',
        ]);

        $course->update([
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'status'      => $request->status,
            'level'       => $request->level ?? $course->level,
            'duration'    => $request->duration ?? $course->duration,
        ]);

        // Append newly uploaded images as slides
        if ($request->hasFile('images')) {
            $nextOrder = ($course->images()->max('sort_order') ?? 0) + 1;
            foreach ($request->file('images') as $file) {
                $imagePath = $file->store('courses/slides', 'public');

                // If public/storage is a separate physical directory (Windows WAMP without symlink)
                $pubDest = public_path('storage/' . $imagePath);
                if (!file_exists($pubDest)) {
                    @mkdir(dirname($pubDest), 0755, true);
                    @copy(storage_path('app/public/' . $imagePath), $pubDest);
                }

                CourseImage::create([
                    'course_id'  => $course->id,
                    'image_path' => $imagePath,
                    'sort_order' => $nextOrder++,
                    'caption'    => 'Slide ' . ($nextOrder - 1),
                ]);
            }
        }

        return redirect()
            ->route('admin.courses.edit', $course->id)
            ->with('success', 'Course updated! Images have been added successfully.');
    }

    /**
     * Permanently delete a single slide image.
     */
    public function destroyImage(Course $course, CourseImage $image)
    {
        if ($image->course_id !== $course->id) {
            return redirect()->back()->with('error', 'Invalid image.');
        }

        // Delete the physical file
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->forceDelete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    /** Soft-delete a course. */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
