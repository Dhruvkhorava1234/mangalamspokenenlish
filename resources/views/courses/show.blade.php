@extends('layouts.app')

@section('title', $course->title . ' &bull; Course Preview &bull; Shree Mangalam')

@section('content')
<!-- Top Hero Preview -->
<div style="background: linear-gradient(135deg, #071930 0%, #0b2545 100%); color: #ffffff; padding: 4rem 0 3rem; border-bottom: 1px solid #1e3a8a;">
    <div class="container">
        
        <div style="display: flex; align-items: center; gap: 0.5rem; color: #67e8f9; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">
            <a href="{{ route('courses') }}" style="color: #67e8f9; text-decoration: none;">Courses</a>
            <span>/</span>
            <span style="color: #ffffff;">{{ $course->level }}</span>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; lg:grid-template-columns: 7fr 5fr; gap: 3rem; align-items: center;">
            <div>
                <h1 style="font-size: 2.5rem; font-weight: 900; line-height: 1.2; margin: 0 0 1rem; color: #ffffff;">
                    {{ $course->title }}
                </h1>
                
                <p style="font-size: 1.1rem; color: #cbd5e1; line-height: 1.6; margin-bottom: 1.5rem;">
                    {{ $course->description }}
                </p>

                <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; font-size: 0.9rem; color: #93c5fd; margin-bottom: 2rem;">
                    <div style="display: flex; align-items: center; gap: 0.4rem;">
                        <i data-lucide="image" style="width: 1.1rem; height: 1.1rem;"></i>
                        <span>{{ $course->images->count() }} Visual Lesson Slides</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.4rem;">
                        <i data-lucide="clock" style="width: 1.1rem; height: 1.1rem;"></i>
                        <span>{{ $course->duration ?? 'Self Paced' }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.4rem;">
                        <i data-lucide="calendar-check" style="width: 1.1rem; height: 1.1rem;"></i>
                        <span>1 Year Full Validity</span>
                    </div>
                </div>

                <!-- Action CTA -->
                @if($hasPurchased)
                    <div style="display: inline-flex; align-items: center; gap: 1rem; background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; padding: 0.85rem 1.5rem; border-radius: 0.85rem;">
                        <i data-lucide="check-circle" style="width: 1.5rem; height: 1.5rem; color: #34d399;"></i>
                        <div>
                            <span style="font-weight: 800; font-size: 0.95rem; color: #34d399; display: block;">You Own This Course</span>
                            <span style="font-size: 0.8rem; color: #e2e8f0;">Full slide deck is unlocked for you.</span>
                        </div>
                        <a href="{{ route('student.courses.viewer', $course->slug) }}" class="btn-primary" style="background-color: #10b981; padding: 0.75rem 1.5rem; margin-left: 1rem;">
                            <span>Open Viewer</span>
                            <i data-lucide="play" style="width: 1rem; height: 1rem;"></i>
                        </a>
                    </div>
                @elseif(Auth::check() && Auth::user()->isAdmin())
                    <div style="display: inline-flex; align-items: center; gap: 1rem; background: rgba(37, 99, 235, 0.1); border: 1px solid #2563eb; padding: 0.85rem 1.5rem; border-radius: 0.85rem;">
                        <i data-lucide="shield-check" style="width: 1.5rem; height: 1.5rem; color: #60a5fa;"></i>
                        <span style="font-weight: 700; color: #60a5fa;">Admin — Full Access</span>
                        <a href="{{ route('student.courses.viewer', $course->slug) }}" class="btn-primary" style="background-color: #2563eb; padding: 0.75rem 1.5rem; margin-left: 1rem;">
                            <span>Preview Viewer</span>
                            <i data-lucide="play" style="width: 1rem; height: 1rem;"></i>
                        </a>
                    </div>
                @else
                    <div style="display: flex; align-items: center; gap: 1.5rem;">
                        <a href="{{ route('checkout.show', $course->slug) }}" class="btn-primary" style="background-color: #2563eb; padding: 1rem 2rem; font-size: 1.1rem; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.4);">
                            <i data-lucide="shopping-bag" style="width: 1.25rem; height: 1.25rem;"></i>
                            <span>Enroll Now &bull; ₹{{ number_format($course->price) }}</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Course Card Box / Pricing Card -->
            <div>
                <div style="background: #ffffff; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.3); border: 4px solid #ffffff; color: #0f172a;">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';" alt="{{ $course->title }}" style="width: 100%; height: 240px; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 240px; background: linear-gradient(135deg, #1e3a8a, #0b2545); display: flex; align-items: center; justify-content: center; color: #ffffff;">
                            <i data-lucide="book-open" style="width: 4rem; height: 4rem;"></i>
                        </div>
                    @endif

                    <div style="padding: 2rem;">
                        <div style="display: flex; align-items: baseline; gap: 0.5rem; margin-bottom: 1.25rem;">
                            <span style="font-size: 2.25rem; font-weight: 900; color: #0f172a;">₹{{ number_format($course->price) }}</span>
                            <span style="color: #64748b; font-size: 0.9rem; text-decoration: line-through;">₹{{ number_format($course->price * 1.5) }}</span>
                            <span style="background: #fef3c7; color: #b45309; font-size: 0.75rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 9999px;">
                                33% OFF
                            </span>
                        </div>

                        @if($hasPurchased || (Auth::check() && Auth::user()->isAdmin()))
                            <a href="{{ route('student.courses.viewer', $course->slug) }}" class="btn-primary" style="width: 100%; padding: 0.9rem; font-size: 1rem; margin-bottom: 1.5rem; justify-content: center; background-color: #10b981;">
                                <span>Access Full Learning Viewer</span>
                            </a>
                        @else
                            <a href="{{ route('checkout.show', $course->slug) }}" class="btn-primary" style="width: 100%; padding: 0.9rem; font-size: 1rem; margin-bottom: 1.5rem; justify-content: center;">
                                <span>Buy Now &bull; Instant Access</span>
                            </a>
                        @endif

                        <h4 style="font-size: 0.85rem; font-weight: 800; text-transform: uppercase; color: #475569; letter-spacing: 0.05em; margin-bottom: 0.75rem;">
                            Course Highlights Include:
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.6rem; font-size: 0.85rem; color: #334155; font-weight: 600;">
                            <li style="display: flex; align-items: center; gap: 0.5rem;">
                                <i data-lucide="check" style="width: 1rem; height: 1rem; color: #10b981;"></i>
                                <span>{{ $course->images->count() }} high-resolution visual slide infographics</span>
                            </li>
                            <li style="display: flex; align-items: center; gap: 0.5rem;">
                                <i data-lucide="check" style="width: 1rem; height: 1rem; color: #10b981;"></i>
                                <span>English with Gujarati context and explanations</span>
                            </li>
                            <li style="display: flex; align-items: center; gap: 0.5rem;">
                                <i data-lucide="check" style="width: 1rem; height: 1rem; color: #10b981;"></i>
                                <span>Mobile &amp; desktop friendly full-screen viewer</span>
                            </li>
                            <li style="display: flex; align-items: center; gap: 0.5rem;">
                                <i data-lucide="check" style="width: 1rem; height: 1rem; color: #10b981;"></i>
                                <span>Continuous batch guidance by Vijay Joshi sir</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Slide Deck Preview & Course Access Gate -->
<div style="background-color: #f8fafc; padding: 4.5rem 0;">
    <div class="container" style="max-width: 960px;">
        
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="background: #e0f2fe; color: #0284c7; padding: 0.3rem 0.85rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 800; text-transform: uppercase;">
                Curriculum Preview
            </span>
            <h2 style="font-size: 2rem; font-weight: 900; color: #0f172a; margin: 0.5rem 0 0.25rem;">
                Image-Based Learning Slides
            </h2>
            <p style="color: #64748b; font-size: 0.95rem;">
                Visual learning helps memorize concepts 3x faster than traditional textbooks.
            </p>
        </div>

        <!-- Access Gate Showcase -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1.5rem; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); position: relative;">
            
            @if($course->images->isNotEmpty())
                <!-- First Slide Preview -->
                <div style="padding: 2rem; text-align: center;">
                    <div style="max-width: 700px; margin: 0 auto; position: relative;">
                        <img src="{{ asset('storage/' . $course->images->first()->image_path) }}" onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';" alt="Lesson Preview" style="width: 100%; height: auto; border-radius: 0.75rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                        
                        <div style="margin-top: 1rem; font-size: 0.9rem; font-weight: 700; color: #475569;">
                            Sample Slide 1: {{ $course->images->first()->caption ?? 'Introductory Concept' }}
                        </div>
                    </div>
                </div>

                <!-- Locked Overlay for Subsequent Slides -->
                @if(! $hasPurchased && ! (Auth::check() && Auth::user()->isAdmin()))
                    <div style="position: relative; background: #0f172a; color: #ffffff; padding: 3.5rem 2rem; text-align: center; border-top: 1px solid #e2e8f0;">
                        <!-- Locked graphic banner -->
                        <div style="width: 4rem; height: 4rem; border-radius: 9999px; background: rgba(239, 68, 68, 0.2); color: #ef4444; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; border: 1px solid rgba(239, 68, 68, 0.4);">
                            <i data-lucide="lock" style="width: 2rem; height: 2rem;"></i>
                        </div>

                        <h3 style="font-size: 1.5rem; font-weight: 800; margin: 0 0 0.5rem; color: #ffffff;">
                            {{ $course->images->count() - 1 }} Remaining Lesson Slides Are Locked
                        </h3>
                        <p style="color: #94a3b8; font-size: 0.95rem; max-width: 520px; margin: 0 auto 1.5rem;">
                            Enroll in this course to immediately unlock the full interactive gallery viewer, sequential notes, and 1 year of study access.
                        </p>

                        <a href="{{ route('checkout.show', $course->slug) }}" class="btn-primary" style="background-color: #2563eb; padding: 0.9rem 2rem; font-size: 1rem; border-radius: 0.75rem;">
                            <i data-lucide="unlock" style="width: 1.1rem; height: 1.1rem;"></i>
                            <span>Unlock All Slides for ₹{{ number_format($course->price) }}</span>
                        </a>
                    </div>
                @else
                    <div style="background: #ecfdf5; border-top: 1px solid #a7f3d0; padding: 2rem; text-align: center;">
                        <h3 style="color: #065f46; font-size: 1.25rem; font-weight: 800; margin: 0 0 0.5rem;">
                            You Have Full Access!
                        </h3>
                        <p style="color: #047857; font-size: 0.9rem; margin-bottom: 1rem;">
                            Launch the interactive slide viewer to view all {{ $course->images->count() }} slides with keyboard and fullscreen support.
                        </p>
                        <a href="{{ route('student.courses.viewer', $course->slug) }}" class="btn-primary" style="background-color: #059669; padding: 0.85rem 1.75rem;">
                            <i data-lucide="play" style="width: 1.1rem; height: 1.1rem;"></i>
                            <span>Open Learning Slideshow</span>
                        </a>
                    </div>
                @endif
            @else
                <div style="padding: 3rem; text-align: center; color: #94a3b8;">
                    <i data-lucide="image" style="width: 3rem; height: 3rem; margin-bottom: 0.5rem;"></i>
                    <p>Slide previews are being configured by the instructor.</p>
                </div>
            @endif

        </div>

    </div>
</div>
@endsection
