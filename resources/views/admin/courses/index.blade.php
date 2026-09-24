@extends('layouts.app')

@section('title', 'Manage Courses &bull; Admin Panel')

@section('content')
<div style="background-color: #f8fafc; min-height: 80vh; padding: 2.5rem 0;">
    <div class="container">

        <!-- Top Breadcrumb & Action -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: #64748b; font-size: 0.85rem; font-weight: 600; text-decoration: none; margin-bottom: 0.4rem;">
                    <i data-lucide="arrow-left" style="width: 1rem; height: 1rem;"></i>
                    <span>Back to Dashboard</span>
                </a>
                <h1 style="font-size: 1.5rem; font-weight: 900; color: #0f172a; margin: 0;">Course Catalog Management</h1>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="btn-primary" style="font-size: 0.9rem; padding: 0.75rem 1.25rem;">
                <i data-lucide="plus" style="width: 1rem; height: 1rem;"></i>
                <span>Add New Course</span>
            </a>
        </div>

        <!-- Course Cards -->
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @forelse($courses as $course)
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
                    <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem;">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';"
                                 alt="{{ $course->title }}"
                                 style="width: 4rem; height: 4rem; object-fit: cover; border-radius: 0.6rem; border: 1px solid #e2e8f0; flex-shrink: 0;">
                        @else
                            <div style="width: 4rem; height: 4rem; flex-shrink: 0; border-radius: 0.6rem; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem;">
                                {{ substr($course->title, 0, 2) }}
                            </div>
                        @endif
                        <div style="flex: 1; min-width: 0;">
                            <h3 style="margin: 0; font-size: 0.95rem; font-weight: 800; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $course->title }}</h3>
                            <p style="margin: 0.2rem 0 0; font-size: 0.78rem; color: #64748b;">{{ $course->level }} &bull; {{ $course->duration }}</p>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.4rem; flex-wrap: wrap;">
                                <span style="font-weight: 800; color: #059669; font-size: 0.85rem;">&#8377;{{ number_format($course->price) }}</span>
                                <span style="color: #cbd5e1;">&bull;</span>
                                <span style="font-size: 0.78rem; color: #64748b;">{{ $course->images_count }} slides</span>
                                <span style="color: #cbd5e1;">&bull;</span>
                                <span style="font-size: 0.78rem; color: #64748b;">{{ $course->paid_orders_count }} enrolled</span>
                            </div>
                        </div>
                        <div style="flex-shrink: 0;">
                            @if($course->status === 'published')
                                <span style="background: #ecfdf5; color: #059669; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 800; white-space: nowrap;">Live</span>
                            @else
                                <span style="background: #fef3c7; color: #b45309; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 800; white-space: nowrap;">Draft</span>
                            @endif
                        </div>
                    </div>
                    <!-- Action Row -->
                    <div style="display: flex; border-top: 1px solid #f1f5f9;">
                        <a href="{{ route('courses.show', $course->slug) }}" target="_blank"
                           style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.75rem 0.5rem; color: #475569; font-size: 0.82rem; font-weight: 600; text-decoration: none; border-right: 1px solid #f1f5f9;">
                            <i data-lucide="external-link" style="width: 1rem; height: 1rem;"></i>
                            <span>Preview</span>
                        </a>
                        <a href="{{ route('admin.courses.edit', $course->id) }}"
                           style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.75rem 0.5rem; color: #2563eb; font-size: 0.82rem; font-weight: 700; text-decoration: none; border-right: 1px solid #f1f5f9;">
                            <i data-lucide="edit-3" style="width: 1rem; height: 1rem;"></i>
                            <span>Edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.courses.destroy', $course->id) }}"
                              onsubmit="return confirm('Delete this course?');" style="flex: 1; display: flex;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.75rem 0.5rem; color: #dc2626; font-size: 0.82rem; font-weight: 700; background: none; border: none; cursor: pointer;">
                                <i data-lucide="trash-2" style="width: 1rem; height: 1rem;"></i>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 3rem; text-align: center; color: #94a3b8;">
                    <i data-lucide="inbox" style="width: 2.5rem; height: 2.5rem; margin: 0 auto 0.75rem; display: block;"></i>
                    <p style="margin: 0; font-weight: 600;">No courses found. Click <strong>Add New Course</strong> above.</p>
                </div>
            @endforelse
        </div>

        @if($courses->hasPages())
            <div style="margin-top: 1.5rem;">
                {{ $courses->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
