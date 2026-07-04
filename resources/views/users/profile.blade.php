@extends('users.layouts.master')

@section('content')

@php
  $user        = $userData['user'];
  $membership  = $userData['membership_level'];
  $totalFunds  = $userData['total_funds']       ?? 0;
  $commission  = $userData['today_commission']  ?? 0;
  $totalComm   = $userData['total_commission']  ?? 0;
  $credibility = $user->credibility             ?? 100;
@endphp

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Your Account</p>
        <h1 class="on-form-heading">{{ $user->name }}</h1>
        <p class="fs-10 text-body-tertiary mb-0">
            Reference code:
            <span id="ref-code-text" class="fw-bold text-black">{{ $user->reference_code }}</span>
            <button type="button"
                class="btn btn-link p-0 ms-1 text-body-tertiary fs-10 align-baseline"
                id="copy-ref-btn"
                onclick="
                    navigator.clipboard.writeText(document.getElementById('ref-code-text').innerText);
                    var btn = document.getElementById('copy-ref-btn');
                    btn.innerHTML = '<i class=\'fas fa-check\'></i>';
                    setTimeout(function(){ btn.innerHTML = '<i class=\'fas fa-copy\'></i>'; }, 1500);
                ">
                <i class="fas fa-copy"></i>
            </button>
        </p>
    </div>

    {{-- Balance + credibility --}}
    <div class="on-card text-center">
        <p class="on-stat-label mb-2">Total Balance &middot; USD</p>
        <p class="on-stat-value" style="font-size:2.5rem;">${{ number_format($totalFunds, 2) }}</p>

        <div class="progress mt-4 mb-2">
            <div class="progress-bar" role="progressbar"
                 style="width:{{ $credibility }}%;"
                 aria-valuenow="{{ $credibility }}" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>
        <p class="fs-10 text-body-tertiary mb-0">Credibility {{ $credibility }}%</p>
    </div>

    {{-- Details --}}
    <div class="on-card">
        <p class="on-card-title">Membership &amp; Earnings</p>

        <div class="on-def-row">
            <span class="on-def-label">Membership</span>
            <span class="on-def-value">{{ $membership->level_name ?? 'Member' }}</span>
        </div>
        <div class="on-def-row">
            <span class="on-def-label">Today&rsquo;s Commission</span>
            <span class="on-def-value">${{ number_format($commission, 2) }}</span>
        </div>
        <div class="on-def-row">
            <span class="on-def-label">Total Commission</span>
            <span class="on-def-value">${{ number_format($totalComm, 2) }}</span>
        </div>
    </div>

    {{-- Actions --}}
    <div class="d-grid gap-2 mt-4">
        <a href="{{ route('user.change-password') }}" class="btn btn-dark py-3">Change Password</a>
        <a href="{{ route('logout') }}"
           class="btn btn-outline-dark py-3"
           onclick="event.preventDefault(); document.getElementById('profile-logout-form').submit();">
            Sign Out
        </a>
        <form id="profile-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</div>

@endsection
