@extends('users.layouts.master')

@section('content')

{{-- ═══ Hero Split ═══════════════════════════════════════════════ --}}
<section class="on-hero-split">

    <a href="{{ route('register') }}" class="on-hero-panel">
        <div class="on-hero-bg"
             style="background-image:url({{ asset('images/w1500_q80.jpg') }})">
        </div>
    </a>

    <a href="{{ route('register') }}" class="on-hero-panel">
        <div class="on-hero-bg"
             style="background-image:url({{ asset('images/' . rawurlencode('w1500_q80 (1).jpg')) }})">
        </div>
    </a>

</section>

{{-- ═══ Category Columns ══════════════════════════════════════════ --}}
<section class="on-cat-section">
    <div class="on-cat-row">

        <div class="on-cat-col">
            <p class="on-cat-title">Women</p>
            <hr class="on-cat-rule">
            <ul class="on-cat-list">
                <li><a href="{{ route('register') }}">Just In</a></li>
                <li><a href="{{ route('register') }}">Bestsellers</a></li>
                <li><a href="{{ route('register') }}">Designers</a></li>
                <li><a href="{{ route('register') }}">Clothing</a></li>
                <li><a href="{{ route('register') }}">Shoes</a></li>
                <li><a href="{{ route('register') }}">Bags</a></li>
                <li><a href="{{ route('register') }}">Accessories</a></li>
            </ul>
        </div>

        <div class="on-cat-col">
            <p class="on-cat-title">Men</p>
            <hr class="on-cat-rule">
            <ul class="on-cat-list">
                <li><a href="{{ route('register') }}">Just In</a></li>
                <li><a href="{{ route('register') }}">Bestsellers</a></li>
                <li><a href="{{ route('register') }}">Designers</a></li>
                <li><a href="{{ route('register') }}">Clothing</a></li>
                <li><a href="{{ route('register') }}">Shoes</a></li>
                <li><a href="{{ route('register') }}">Bags</a></li>
                <li><a href="{{ route('register') }}">Accessories</a></li>
            </ul>
        </div>

    </div>
</section>

{{-- ═══ CTA ════════════════════════════════════════════════════════ --}}
<section class="on-home-cta">
    <p class="on-home-cta-eyebrow">Exclusive Designer Offers &mdash; Up to 70% Off</p>
    <h2 class="on-home-cta-heading">New Season. New Savings.</h2>
    <p class="on-home-cta-body">
        Curate your wardrobe with premium designer pieces at unbeatable prices.
        Evaluate products, earn daily commission, and build a wardrobe you love.
    </p>
    <div class="on-home-cta-actions">
        <a href="{{ route('register') }}" class="btn btn-dark">Create Account</a>
        <a href="{{ route('users.about') }}" class="btn btn-outline-dark">Learn More</a>
    </div>
    <p class="on-home-signin">
        Already a member? <a href="{{ route('user.login') }}">Sign in &rarr;</a>
    </p>
</section>

{{-- ═══ Feature Bar ════════════════════════════════════════════════ --}}
<section class="on-features">
    <div class="on-features-row">

        <div class="on-feature">
            <span class="on-feature-mark">✦</span>
            <p class="on-feature-title">Up to 70% Off</p>
            <p class="on-feature-body">Premium designer pieces at prices that make sense.</p>
        </div>

        <div class="on-feature">
            <span class="on-feature-mark">✦</span>
            <p class="on-feature-title">Daily Earnings</p>
            <p class="on-feature-body">Evaluate products daily and earn real commission rewards.</p>
        </div>

        <div class="on-feature">
            <span class="on-feature-mark">✦</span>
            <p class="on-feature-title">Trusted Platform</p>
            <p class="on-feature-body">Secure, transparent, and built for your success.</p>
        </div>

    </div>
</section>

@endsection
