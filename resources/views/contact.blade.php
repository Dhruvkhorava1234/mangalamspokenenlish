@extends('layouts.app')

@section('title', 'Contact Us | Shree Mangalam Spoken English Classes Porbandar')

@section('content')
    <!-- Page Banner Header -->
    <section class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <span class="page-banner-badge">Get In Touch</span>
                <h1 class="page-banner-title">Contact &amp; Admissions</h1>
                <p class="page-banner-sub">
                    Have questions about batches, fees, or timings? Reach out directly or visit our academy in Porbandar.
                </p>
                <div class="breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span class="active">Contact</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Details & Inquiry Form Section -->
    <section class="contact-page-section">
        <div class="container">
            <div class="contact-grid">

                <!-- Left Column: Contact Details Cards -->
                <div class="contact-info-col">
                    <div class="section-label">
                        <i data-lucide="map-pin" style="width: 1rem; height: 1rem;"></i>
                        <span>Reach Us In Porbandar</span>
                    </div>
                    <h2 class="contact-subheading font-gujarati">
                        રૂબરૂ મુલાકાત અથવા ફોન દ્વારા પૂછપરછ કરો
                    </h2>
                    <p class="contact-intro">
                        Our admission desk is open from Monday to Saturday (9:00 AM to 7:00 PM). Feel free to visit or WhatsApp us anytime.
                    </p>

                    <!-- Contact Details Card -->
                    <div class="contact-methods-stack">
                        <!-- Phone & WhatsApp -->
                        <div class="contact-card-item">
                            <div class="contact-circle-icon ic-phone">
                                <i data-lucide="phone-call" style="width: 1.5rem; height: 1.5rem;"></i>
                            </div>
                            <div>
                                <h4 class="cm-title">Direct Phone / Calling</h4>
                                <a href="tel:+919033965711" class="cm-link">+91 9033965711</a>
                                <p class="cm-sub">Direct counseling with Vijay Joshi</p>
                            </div>
                        </div>

                        <!-- WhatsApp Quick Chat -->
                        <div class="contact-card-item">
                            <div class="contact-circle-icon ic-wa">
                                <i data-lucide="message-circle" style="width: 1.5rem; height: 1.5rem;"></i>
                            </div>
                            <div>
                                <h4 class="cm-title">WhatsApp Support</h4>
                                <a href="https://wa.me/919033965711" target="_blank" rel="noopener noreferrer" class="cm-link">+91 9033965711</a>
                                <p class="cm-sub">Instant response on batch details &amp; PDF syllabus</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="contact-card-item">
                            <div class="contact-circle-icon ic-mail">
                                <i data-lucide="mail" style="width: 1.5rem; height: 1.5rem;"></i>
                            </div>
                            <div>
                                <h4 class="cm-title">Official Email</h4>
                                <a href="mailto:joshi.vijay700@gmail.com" class="cm-link">joshi.vijay700@gmail.com</a>
                                <p class="cm-sub">Send us your queries anytime</p>
                            </div>
                        </div>

                        <!-- Classroom Address -->
                        <div class="contact-card-item">
                            <div class="contact-circle-icon ic-location">
                                <i data-lucide="building" style="width: 1.5rem; height: 1.5rem;"></i>
                            </div>
                            <div>
                                <h4 class="cm-title">Classroom Address</h4>
                                <p class="cm-address font-gujarati">
                                    Shivkuber Complex, S10, Zudio Cloth Store Ni Same, Uganda Road, Porbandar, Gujarat - 360575
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Admission Inquiry Form -->
                <div class="contact-form-col">
                    <div class="inquiry-form-card">
                        <div class="form-header">
                            <h3 class="form-title">Send Admission Inquiry</h3>
                            <p class="form-subtitle">Fill in the details below and we will contact you with batch schedules.</p>
                        </div>

                        @if(session('success'))
                            <div style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: #047857; padding: 1rem 1.25rem; border-radius: 0.75rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                                <i data-lucide="check-circle" style="width: 1.25rem; height: 1.25rem; flex-shrink: 0; color: #10b981;"></i>
                                <span style="font-size: 0.95rem; font-weight: 500;">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if(session('error'))
                            <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); color: #b91c1c; padding: 1rem 1.25rem; border-radius: 0.75rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                                <i data-lucide="alert-circle" style="width: 1.25rem; height: 1.25rem; flex-shrink: 0; color: #ef4444;"></i>
                                <span style="font-size: 0.95rem; font-weight: 500;">{{ session('error') }}</span>
                            </div>
                        @endif

                        @if($errors->any())
                            <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.3); color: #b91c1c; padding: 0.85rem 1.25rem; border-radius: 0.75rem; margin-bottom: 1.5rem; font-size: 0.9rem;">
                                <ul style="margin: 0; padding-left: 1.2rem;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="custom-form" action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="user_name" class="form-label">Full Name / પૂરું નામ *</label>
                                <input type="text" id="user_name" name="name" class="form-input" value="{{ old('name') }}" placeholder="e.g. Rahul Patel" required>
                            </div>

                            <div class="form-row-2">
                                <div class="form-group">
                                    <label for="user_phone" class="form-label">Phone Number / મોબાઇલ *</label>
                                    <input type="tel" id="user_phone" name="phone" class="form-input" value="{{ old('phone') }}" placeholder="e.g. 9876543210" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_email" class="form-label">Email Address (Optional)</label>
                                    <input type="email" id="user_email" name="email" class="form-input" value="{{ old('email') }}" placeholder="e.g. rahul@example.com">
                                </div>
                            </div>

                            <div class="form-row-2">
                                <div class="form-group">
                                    <label for="user_category" class="form-label">I am a / શ્રેણી</label>
                                    <select id="user_category" name="category" class="form-select">
                                        <option value="Student" {{ old('category') == 'Student' ? 'selected' : '' }}>Student (School / College)</option>
                                        <option value="Homemaker" {{ old('category') == 'Homemaker' ? 'selected' : '' }}>Homemaker / Housewife</option>
                                        <option value="Professional" {{ old('category') == 'Professional' ? 'selected' : '' }}>Working Professional</option>
                                        <option value="Business Person" {{ old('category') == 'Business Person' ? 'selected' : '' }}>Business Person</option>
                                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="user_course" class="form-label">Course Interested In / રસ ધરાવતો કોર્સ *</label>
                                    <select id="user_course" name="course" class="form-select" required>
                                        <option value="Spoken English Course" {{ old('course') == 'Spoken English Course' ? 'selected' : '' }}>Spoken English Course</option>
                                        <option value="Basic English Course" {{ old('course') == 'Basic English Course' ? 'selected' : '' }}>Basic English Course</option>
                                        <option value="English Grammar Course" {{ old('course') == 'English Grammar Course' ? 'selected' : '' }}>English Grammar Course</option>
                                        <option value="English Grammar Practice" {{ old('course') == 'English Grammar Practice' ? 'selected' : '' }}>English Grammar Practice</option>
                                        <option value="English Vocabulary Course" {{ old('course') == 'English Vocabulary Course' ? 'selected' : '' }}>English Vocabulary Course</option>
                                        <option value="IELTS Life Skills" {{ old('course') == 'IELTS Life Skills' ? 'selected' : '' }}>IELTS Life Skills</option>
                                        <option value="Israel Interview Preparation" {{ old('course') == 'Israel Interview Preparation' ? 'selected' : '' }}>Israel Interview</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_message" class="form-label">Message or Preferred Timing (Optional)</label>
                                <textarea id="user_message" name="message" rows="3" class="form-textarea" placeholder="Tell us if you prefer morning or evening batches...">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="btn-primary" style="width: 100%; padding: 0.9rem 1.5rem; font-size: 1rem; border-radius: 0.75rem;">
                                <span>Submit Inquiry</span>
                                <i data-lucide="send" style="width: 1.1rem; height: 1.1rem;"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
