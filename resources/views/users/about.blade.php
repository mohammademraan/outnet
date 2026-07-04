@extends('users.layouts.master')

@section('content')

<div class="on-page">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Our Story</p>
        <h1 class="on-form-heading">About THE OUTNET</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <p>
                THE OUTNET was created with a bold vision: to bring premium designer fashion to
                everyone at prices that make sense. What began as a curated digital boutique has
                grown into one of the most trusted destinations for discounted designer pieces,
                serving a global community of style lovers across more than 200 countries.
            </p>

            <p>
                We partner with the world&rsquo;s most coveted designers to offer previous-season
                collections at up to 70% off, alongside our member evaluation programme that
                rewards our community for engaging with the products they love.
            </p>

            {{-- Image pair --}}
            <div class="row g-3 my-4">
                <div class="col-6">
                    <img class="img-fluid w-100" style="aspect-ratio:4/5;object-fit:cover;"
                         src="{{ asset('images/w1500_q80.jpg') }}" alt="THE OUTNET Style" />
                </div>
                <div class="col-6">
                    <img class="img-fluid w-100" style="aspect-ratio:4/5;object-fit:cover;"
                         src="{{ asset('images/' . rawurlencode('w1500_q80 (1).jpg')) }}" alt="THE OUTNET Community" />
                </div>
            </div>

            {{-- Quote --}}
            <blockquote class="text-center my-5 py-4" style="border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;">
                <p class="on-form-heading" style="font-size:1.3rem;font-style:italic;">
                    &ldquo;Fashion is not about being perfect. It is about expressing who you are
                    and feeling confident doing it.&rdquo;
                </p>
                <footer class="fs-10 text-body-tertiary text-uppercase" style="letter-spacing:0.16em;">
                    THE OUTNET Editorial Team
                </footer>
            </blockquote>

            {{-- Stats --}}
            <div class="on-stat-grid my-5">
                <div class="on-stat">
                    <p class="on-stat-label">Years of Experience</p>
                    <p class="on-stat-value">20+</p>
                </div>
                <div class="on-stat">
                    <p class="on-stat-label">Customers Worldwide</p>
                    <p class="on-stat-value">75M</p>
                </div>
                <div class="on-stat">
                    <p class="on-stat-label">Designer Brands</p>
                    <p class="on-stat-value">350+</p>
                </div>
            </div>

            {{-- Values --}}
            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <p class="on-card-title">Innovation</p>
                    <p class="fs-10 text-body-tertiary">
                        We pioneered a digital-first commerce model long before it became an
                        industry standard. By leveraging a lightning-fast supply chain, we
                        consistently bring fresh designer collections to our members within days
                        of availability — redefining what speed-to-market means in fashion.
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="on-card-title">Community</p>
                    <p class="fs-10 text-body-tertiary">
                        Our community is everything. From size-inclusive collections that celebrate
                        every body to our global evaluation programme, we have built a brand rooted
                        in inclusivity, self-expression, and shared reward. Our members are not just
                        shoppers — they are co-creators of THE OUTNET story.
                    </p>
                </div>
            </div>

            {{-- CTA --}}
            @guest
            <div class="text-center mt-5">
                <a href="{{ route('register') }}" class="btn btn-dark px-5 py-3">Join Us Today</a>
            </div>
            @endguest

        </div>
    </div>

</div>

@endsection
