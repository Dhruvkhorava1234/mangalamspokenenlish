@extends('layouts.app')

@section('title', 'Courses &bull; Shree Mangalam Spoken English Classes')

@section('content')
    <!-- Page Banner Header -->
    <section class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <span class="page-banner-badge">Our Curriculum</span>
                <h1 class="page-banner-title">Comprehensive English Courses</h1>
                <p class="page-banner-sub">
                    Carefully structured image-based modules from baseline grammar to professional spoken communication.
                </p>
                <div class="breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span class="active">Courses</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Dynamic Courses Catalog from Database -->
    <section class="courses-catalog-section">
        <div class="container">
            <div class="courses-detailed-list">

                @forelse($courses as $index => $course)
                    @php
                        $colorClasses = ['cd-blue', 'cd-red', 'cd-amber', 'cd-teal', 'cd-purple'];
                        $headerClass = $colorClasses[$index % count($colorClasses)];
                    @endphp
                    <div class="course-detail-card">
                        <div class="course-detail-header {{ $headerClass }}">
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';" alt="{{ $course->title }}" style="width: 5.5rem; height: 5.5rem; object-fit: cover; border-radius: 1rem; box-shadow: var(--shadow-md); border: 2px solid #ffffff;">
                            @else
                                <div class="course-detail-icon">
                                    <i data-lucide="book-open" style="width: 2.25rem; height: 2.25rem;"></i>
                                </div>
                            @endif

                            <div class="course-detail-meta">
                                @if(in_array($course->id, $purchasedCourseIds ?? []))
                                    <span class="badge-tag" style="background: rgba(16, 185, 129, 0.9); color: #ffffff; font-weight: 800;">
                                        <i data-lucide="check" style="width: 0.8rem; height: 0.8rem; display: inline-block; vertical-align: -1px;"></i> Enrolled
                                    </span>
                                @endif
                                <span class="badge-tag">{{ $course->level }}</span>
                                <span class="badge-tag">{{ $course->images_count }} Visual Slides</span>
                            </div>
                        </div>

                        <div class="course-detail-body">
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 0.5rem;">
                                    <h2 class="cd-title" style="margin: 0;">{{ $course->title }}</h2>
                                    <div style="font-size: 1.5rem; font-weight: 900; color: #059669;">
                                        ₹{{ number_format($course->price) }}
                                    </div>
                                </div>

                                <p class="cd-summary">
                                    {{ $course->description }}
                                </p>
                            </div>

                            <div class="cd-footer">
                                <div class="cd-specs">
                                    <div><strong>Duration:</strong> {{ $course->duration ?? 'Self Paced' }}</div>
                                    <div><strong>Format:</strong> Visual Learning Slides</div>
                                    <div><strong>Validity:</strong> 1 Year Active Access</div>
                                </div>

                                <div style="display: flex; gap: 0.75rem; align-items: center;">
                                    <a href="{{ route('courses.show', $course->slug) }}" class="btn-secondary" style="padding: 0.65rem 1.25rem;">
                                        <span>Preview &amp; Syllabus</span>
                                    </a>
                                    
                                    @if(in_array($course->id, $purchasedCourseIds ?? []))
                                        <a href="{{ route('student.courses.viewer', $course->slug) }}" class="btn-primary" style="padding: 0.65rem 1.5rem; background-color: #10b981; border-color: #10b981;">
                                            <i data-lucide="play-circle" style="width: 1rem; height: 1rem;"></i>
                                            <span>Access Course</span>
                                        </a>
                                    @else
                                        <a href="{{ route('checkout.show', $course->slug) }}" class="btn-primary" style="padding: 0.65rem 1.5rem;">
                                            <i data-lucide="shopping-cart" style="width: 1rem; height: 1rem;"></i>
                                            <span>Buy Now</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 4rem 1rem; background: #ffffff; border-radius: 1rem; border: 1px dashed #cbd5e1;">
                        <i data-lucide="book-open" style="width: 3rem; height: 3rem; color: #94a3b8; margin-bottom: 0.75rem;"></i>
                        <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a;">Courses will be available soon!</h3>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- Bottom Consultation CTA -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-banner">
                <div class="cta-left">
                    <div class="cta-icon-box">
                        <i data-lucide="help-circle" style="width: 2rem; height: 2rem;"></i>
                    </div>
                    <div>
                        <h3 class="cta-heading">Not Sure Which Course Fits You Best?</h3>
                        <p class="cta-desc">
                            Schedule a free skill evaluation session with Vijay Joshi sir at our Porbandar centre.
                        </p>
                    </div>
                </div>
                <div class="cta-right">
                    <a href="tel:+919033965711" class="btn-primary cta-button">
                        <i data-lucide="phone" style="width: 1.1rem; height: 1.1rem;"></i>
                        <span>Call +91 9033965711</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
