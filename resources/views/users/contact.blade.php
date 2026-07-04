@extends('users.layouts.master')

@section('content')

<div class="on-page">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Get in Touch</p>
        <h1 class="on-form-heading">Contact Us</h1>
        <p class="on-form-sub">
            We love hearing from our community. Reach out for order help, account questions,
            or partnership enquiries &mdash; our team typically replies within one business day.
        </p>
    </div>

    <div class="row g-4 justify-content-center">

        {{-- Left: contact info --}}
        <div class="col-lg-5">

            <div class="on-card">
                <p class="on-card-title">Contact Details</p>
                <div class="on-def-row">
                    <span class="on-def-label">Email</span>
                    <span class="on-def-value">support@theoutnet.com</span>
                </div>
                <div class="on-def-row">
                    <span class="on-def-label">Phone</span>
                    <span class="on-def-value">+1 (800) 555-0174</span>
                </div>
                <div class="on-def-row">
                    <span class="on-def-label">Headquarters</span>
                    <span class="on-def-value">New York, NY, United States</span>
                </div>
            </div>

            <div class="on-card">
                <p class="on-card-title">Support Hours</p>
                <div class="on-def-row">
                    <span class="on-def-label">Mon &ndash; Fri</span>
                    <span class="on-def-value">6:00 AM &ndash; 9:00 PM ET</span>
                </div>
                <div class="on-def-row">
                    <span class="on-def-label">Saturday</span>
                    <span class="on-def-value">7:00 AM &ndash; 6:00 PM ET</span>
                </div>
                <div class="on-def-row">
                    <span class="on-def-label">Sunday</span>
                    <span class="on-def-value">8:00 AM &ndash; 4:00 PM ET</span>
                </div>
            </div>

        </div>

        {{-- Right: contact form --}}
        <div class="col-lg-6">
            <div class="on-card">
                <p class="on-card-title">Send Us a Message</p>

                @if (session('success'))
                    <div class="alert alert-success fs-10 mb-3">{{ session('success') }}</div>
                @endif

                <form action="mailto:support@theoutnet.com" method="post" enctype="text/plain">
                    <div class="mb-4">
                        <label class="on-field-label">Full Name</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
                    <div class="mb-4">
                        <label class="on-field-label">Email Address</label>
                        <input class="form-control" type="email" name="email" required>
                    </div>
                    <div class="mb-4">
                        <label class="on-field-label">Subject</label>
                        <input class="form-control" type="text" name="subject" required>
                    </div>
                    <div class="mb-4">
                        <label class="on-field-label">Message</label>
                        <textarea class="form-control" name="message" rows="4" required></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark py-3">Send Message</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

@endsection
