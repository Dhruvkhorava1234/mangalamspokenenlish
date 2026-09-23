@extends('layouts.app')

@section('title', 'Manage Courses &bull; Admin Panel')

@section('content')
<div style="background-color: #f8fafc; min-height: 80vh; padding: 2.5rem 0;">
    <div class="container">

        <!-- Top Breadcrumb & Action -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: #64748b; font-size: 0.85rem; font-weight: 600; text-decoration: none; margin-bottom: 0.4rem;">
                    <i data-lucide="arrow-left" style="width: 1rem; height: 1rem;"></i>
                    <span>Back to Dashboard</span>
                </a>
                <h1 style="font-size: 1.85rem; font-weight: 900; color: #0f172a; margin: 0;">Course Catalog Management</h1>
            </div>

            <a href="{{ route('admin.courses.create') }}" class="btn-primary" style="font-size: 0.9rem; padding: 0.75rem 1.5rem;">
                <i data-lucide="plus" style="width: 1rem; height: 1rem;"></i>
                <span>Add New Course</span>
            </a>
        </div>

        <!-- Courses Table -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 0.8rem; text-transform: uppercase;">
                            <th style="padding: 1rem;">Course</th>
                            <th style="padding: 1rem;">Price</th>
                            <th style="padding: 1rem;">Slides</th>
                            <th style="padding: 1rem;">Sales</th>
                            <th style="padding: 1rem;">Status</th>
                            <th style="padding: 1rem; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 1rem; display: flex; align-items: center; gap: 1rem;">
                                    @if($course->thumbnail)
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';" alt="{{ $course->title }}" style="width: 3.5rem; height: 3.5rem; object-fit: cover; border-radius: 0.5rem; border: 1px solid #e2e8f0;">
                                    @else
                                        <div style="width: 3.5rem; height: 3.5rem; border-radius: 0.5rem; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem;">
                                            {{ substr($course->title, 0, 2) }}
                                        </div>
                                    @endif
                                    <div>
                                        <h3 style="margin: 0; font-size: 0.95rem; font-weight: 800; color: #0f172a;">{{ $course->title }}</h3>
                                        <p style="margin: 0.15rem 0 0; font-size: 0.8rem; color: #64748b;">{{ $course->level }} &bull; {{ $course->duration }}</p>
                                    </div>
                                </td>
                                <td style="padding: 1rem; font-weight: 800; color: #059669;">
                                    ₹{{ number_format($course->price) }}
                                </td>
                                <td style="padding: 1rem;">
                                    <span style="display: inline-flex; align-items: center; gap: 0.35rem; background: #f1f5f9; padding: 0.25rem 0.65rem; border-radius: 0.375rem; font-size: 0.8rem; font-weight: 700; color: #475569;">
                                        <i data-lucide="image" style="width: 0.85rem; height: 0.85rem;"></i>
                                        <span>{{ $course->images_count }} slides</span>
                                    </span>
                                </td>
                                <td style="padding: 1rem; font-weight: 700; color: #1e293b;">
                                    {{ $course->paid_orders_count }} enrolled
                                </td>
                                <td style="padding: 1rem;">
                                    @if($course->status === 'published')
                                        <span style="background: #ecfdf5; color: #059669; padding: 0.25rem 0.65rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 800;">Published</span>
                                    @else
                                        <span style="background: #fef3c7; color: #b45309; padding: 0.25rem 0.65rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 800;">Draft</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem; text-align: right;">
                                    <div style="display: inline-flex; gap: 0.5rem;">
                                        <a href="{{ route('courses.show', $course->slug) }}" target="_blank" class="btn-secondary" style="padding: 0.4rem 0.75rem; font-size: 0.8rem;" title="View Preview">
                                            <i data-lucide="external-link" style="width: 0.9rem; height: 0.9rem;"></i>
                                        </a>
                                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn-primary" style="padding: 0.4rem 0.85rem; font-size: 0.8rem; background-color: #2563eb;" title="Edit Course">
                                            <i data-lucide="edit-3" style="width: 0.9rem; height: 0.9rem;"></i>
                                            <span>Edit</span>
                                        </a>
                                        <form method="POST" action="{{ route('admin.courses.destroy', $course->id) }}" onsubmit="return confirm('Are you sure you want to delete this course? You can restore it anytime.');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-secondary" style="padding: 0.4rem 0.75rem; font-size: 0.8rem; color: #dc2626; border-color: #fecaca;" title="Delete Course">
                                                <i data-lucide="trash-2" style="width: 0.9rem; height: 0.9rem;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 3rem; text-align: center; color: #94a3b8;">
                                    No courses found. Click <strong>Add New Course</strong> above.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($courses->hasPages())
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #e2e8f0;">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
