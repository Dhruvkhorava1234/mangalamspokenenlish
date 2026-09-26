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

                        <form class="custom-form" onsubmit="event.preventDefault(); alert('Thank you! Your inquiry has been received. We will contact you at ' + document.getElementById('user_phone').value);">
                            <div class="form-group">
                                <label for="user_name" class="form-label">Full Name / પૂરું નામ *</label>
                                <input type="text" id="user_name" class="form-input" placeholder="e.g. Rahul Patel" required>
                            </div>

                            <div class="form-row-2">
                                <div class="form-group">
                                    <label for="user_phone" class="form-label">Phone Number / મોબાઇલ *</label>
                                    <input type="tel" id="user_phone" class="form-input" placeholder="e.g. 9876543210" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_category" class="form-label">I am a / શ્રેણી</label>
                                    <select id="user_category" class="form-select">
                                        <option value="student">Student (School / College)</option>
                                        <option value="housewife">Homemaker / Housewife</option>
                                        <option value="professional">Working Professional</option>
                                        <option value="businessman">Business Person</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_course" class="form-label">Course Interested In / રસ ધરાવતો કોર્સ</label>
                                <select id="user_course" class="form-select">
                                    <option value="spoken">Spoken English Course</option>
                                    <option value="basic">Basic English Course</option>
                                    <option value="grammar">English Grammar Course</option>
                                    <option value="practice">English Grammar Practice</option>
                                    <option value="vocabulary">English Vocabulary Course</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="user_message" class="form-label">Message or Preferred Timing (Optional)</label>
                                <textarea id="user_message" rows="3" class="form-textarea" placeholder="Tell us if you prefer morning or evening batches..."></textarea>
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
