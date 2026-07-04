@extends('users.layouts.master')

@section('content')

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Company Introduction</p>
        <h1 class="on-form-heading">Fashion Forward. Inclusively Designed.</h1>
    </div>

    <div style="line-height:1.85;">
        <p>
            <strong>THE OUTNET</strong> is a global fashion destination dedicated to making
            premium designer style accessible, affordable, and inclusive for everyone.
        </p>
        <p>
            Fashion has traditionally been gatekept by luxury price tags, limited size ranges,
            and a narrow definition of beauty. Today&rsquo;s fashion-conscious consumer demands
            something different &mdash; the ability to express their personal style with quality
            pieces that celebrate diverse bodies, cultures, and identities at prices they can
            actually afford.
        </p>
        <p>
            We recognized that the future of fashion lies in democratization &mdash; when
            customers of all sizes, styles, and budgets can access premium designer pieces,
            express their authentic selves, and shop with confidence knowing they&rsquo;re
            supporting ethical, sustainable practices.
        </p>
        <p>
            We deliver previous-season designer collections through an intuitive e-commerce
            platform, inclusive sizing, fast worldwide shipping, and transparent pricing &mdash;
            putting designer-quality fashion in the hands of every customer.
        </p>
    </div>

    {{-- Stats --}}
    <div class="on-stat-grid my-5">
        <div class="on-stat">
            <p class="on-stat-label">Customers</p>
            <p class="on-stat-value">2.3M+</p>
        </div>
        <div class="on-stat">
            <p class="on-stat-label">Countries</p>
            <p class="on-stat-value">150+</p>
        </div>
        <div class="on-stat">
            <p class="on-stat-label">Styles</p>
            <p class="on-stat-value">5,000+</p>
        </div>
        <div class="on-stat">
            <p class="on-stat-label">Satisfaction</p>
            <p class="on-stat-value">98%</p>
        </div>
    </div>

    {{-- Mission / Vision --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="on-card h-100">
                <p class="on-card-title">Our Mission</p>
                <p class="fs-10 text-body-tertiary mb-0" style="line-height:1.8;">
                    To democratize fashion by giving every customer access to premium, quality,
                    affordable designer pieces in inclusive sizes with ethical production and
                    outstanding service.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="on-card h-100">
                <p class="on-card-title">Our Vision</p>
                <p class="fs-10 text-body-tertiary mb-0" style="line-height:1.8;">
                    To be the world&rsquo;s most trusted fashion destination where style,
                    inclusivity, and authenticity drive confidence and self-expression for
                    millions of customers globally.
                </p>
            </div>
        </div>
    </div>

    {{-- Pillars --}}
    <div class="row g-4 mt-1">
        <div class="col-md-4">
            <div class="on-card h-100 text-center">
                <span class="fas fa-lock fa-lg d-block mb-3 text-secondary"></span>
                <p class="on-card-title border-0 pb-0 mb-2">Security First</p>
                <p class="fs-10 text-body-tertiary mb-0">
                    Encrypted transactions and verified payment partners protect every order.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="on-card h-100 text-center">
                <span class="fas fa-hand-holding-usd fa-lg d-block mb-3 text-secondary"></span>
                <p class="on-card-title border-0 pb-0 mb-2">Transparent Returns</p>
                <p class="fs-10 text-body-tertiary mb-0">
                    Clear pricing, fair shipping, and a 30-day return window on every order.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="on-card h-100 text-center">
                <span class="fas fa-globe fa-lg d-block mb-3 text-secondary"></span>
                <p class="on-card-title border-0 pb-0 mb-2">Global Shipping</p>
                <p class="fs-10 text-body-tertiary mb-0">
                    Fast worldwide delivery with local payment options in 150+ countries.
                </p>
            </div>
        </div>
    </div>

    {{-- Contact --}}
    <div class="on-card mt-4">
        <p class="on-card-title">Get in Touch</p>
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

</div>

@endsection
