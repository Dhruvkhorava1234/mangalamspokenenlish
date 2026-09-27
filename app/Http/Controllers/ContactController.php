<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Handle the contact inquiry submission.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:150',
            'category' => 'nullable|string|max:50',
            'course' => 'required|string|max:100',
            'message' => 'nullable|string|max:2000',
        ]);

        $recipient = env('CONTACT_FORM_RECIPIENT', 'joshi.vijay700@gmail.com');

        try {
            Mail::to($recipient)->send(new ContactInquiryMail($validated));
        } catch (\Exception $e) {
            Log::error('Failed to send contact inquiry email: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'We received your inquiry, but there was an issue sending the email notification. Please call or WhatsApp us directly at +91 9033965711.');
        }

        return redirect()->back()
            ->with('success', 'Thank you! Your inquiry has been sent successfully. We will contact you soon.');
    }
}
