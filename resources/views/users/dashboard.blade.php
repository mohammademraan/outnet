@extends('users.layouts.master')

@section('content')

<div class="on-page">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Your Account</p>
        <h1 class="on-form-heading">Hi, {{ $userData['user']->name }}</h1>
    </div>

    {{-- Session messages --}}
    @if (session('order_success_message'))
        <div class="alert alert-success fs-10 mb-3">{{ session('order_success_message') }}</div>
    @endif
    @if (session('order_message'))
        <div class="alert alert-warning fs-10 mb-3">{{ session('order_message') }}</div>
    @endif
    @if (session('account_message'))
        <div class="alert alert-danger fs-10 mb-3">{{ session('account_message') }}</div>
    @endif

    <div class="row g-4">

        {{-- Left column: balance + stats + evaluate --}}
        <div class="col-lg-7">

            <div class="on-card text-center">
                <p class="on-stat-label mb-2">Total Balance &middot; USD</p>
                <p class="on-stat-value" style="font-size:2.75rem;">
                    ${{ number_format($userData['total_funds'] ?? 0, 2) }}
                </p>

                <div class="d-grid mt-4">
                    <a href="{{ route('generate.order') }}" class="btn btn-dark py-3">
                        Evaluate Now
                    </a>
                </div>
            </div>

            <div class="on-stat-grid mt-4">
                <div class="on-stat">
                    <p class="on-stat-label">Total Products</p>
                    <p class="on-stat-value">{{ $userData['order_limit'] ?? 0 }}</p>
                </div>
                <div class="on-stat">
                    <p class="on-stat-label">Completed Today</p>
                    <p class="on-stat-value">{{ $userData['total_today_orders'] ?? 0 }}</p>
                </div>
                <div class="on-stat">
                    <p class="on-stat-label">Today&rsquo;s Commission</p>
                    <p class="on-stat-value">${{ number_format($userData['today_commission'] ?? 0, 2) }}</p>
                </div>
            </div>

        </div>

        {{-- Right column: quick actions --}}
        <div class="col-lg-5">

            <div class="on-card">
                <p class="on-card-title">Quick Actions</p>

                <div class="on-tile-grid">
                    <a class="on-tile" href="{{ route('user.wallet') }}">
                        <i class="fas fa-wallet"></i> Wallet
                    </a>
                    <a class="on-tile" href="{{ route('user.recharge') }}">
                        <i class="fas fa-arrow-down"></i> Deposit
                    </a>
                    <a class="on-tile" href="{{ route('user.redemption') }}">
                        <i class="fas fa-arrow-up"></i> Withdraw
                    </a>
                    <a class="on-tile" href="{{ route('user.profile') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <a class="on-tile" href="{{ route('user.tasks') }}">
                        <i class="fas fa-history"></i> History
                    </a>
                    <a class="on-tile" href="{{ route('user.support') }}">
                        <i class="fas fa-headset"></i> Support
                    </a>
                    <a class="on-tile" href="{{ route('user.faqs') }}">
                        <i class="fas fa-question-circle"></i> FAQs
                    </a>
                    <a class="on-tile" href="{{ route('user.company') }}">
                        <i class="fas fa-building"></i> Company
                    </a>
                    <a class="on-tile" href="{{ route('user.terms') }}">
                        <i class="fas fa-file-alt"></i> Terms
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection
