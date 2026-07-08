@extends('users.layouts.master')

@section('content')

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">We&rsquo;re Here to Help</p>
        <h1 class="on-form-heading">Support</h1>
    </div>

    @if (session('blc_message'))
        <div class="alert alert-warning fs-10 mb-3">{{ session('blc_message') }}</div>
    @endif

    {{-- Intro card --}}
    <div class="on-card text-center">
        <span class="fas fa-headset fa-2x text-secondary mb-3 d-block"></span>
        <h2 class="on-form-heading" style="font-size:1.35rem;">24/7 Customer Care</h2>
        <p class="fs-10 text-body-tertiary mb-0">
            Our team is available around the clock to assist you with deposits,
            withdrawals, evaluations, and account management.
        </p>
    </div>

    {{-- Contact details --}}
    <div class="on-card">
        <p class="on-card-title">Contact Details</p>

        <div class="on-def-row">
            <span class="on-def-label">Email</span>
            <span class="on-def-value">support@theoutnet.com</span>
        </div>
        <div class="on-def-row">
            <span class="on-def-label">Live Chat</span>
            <span class="on-def-value">Instant response</span>
        </div>
        <div class="on-def-row">
            <span class="on-def-label">Response Time</span>
            <span class="on-def-value">Within 2 hours</span>
        </div>
    </div>

    {{-- Live chat --}}
    <div class="d-grid mt-4">
        <button type="button"
                class="btn btn-dark py-3"
                onclick="if(window.LiveChatWidget){window.LiveChatWidget.call('maximize');}else{alert('Chat is currently unavailable. Please email support@theoutnet.com');}">
            Start Live Chat
        </button>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('user.faqs') }}" class="on-text-link fs-10">
            View frequently asked questions &rarr;
        </a>
    </div>

</div>

@endsection
