@extends('users.layouts.master')

@section('content')

@php
  $user         = auth()->user();
  $balance      = $adjustedTotalFunds ?? 0;
  $minWithdraw  = $user->min_withdraw ?? 50;
  $maxWithdraw  = min($user->max_withdraw ?? 2000, $balance);
  $linkedWallet = \App\Models\UserVallet::where('user_id', $user->id)->first();
@endphp

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Your Funds</p>
        <h1 class="on-form-heading">Withdraw</h1>
    </div>

    {{-- Session alerts --}}
    @if (session('success'))
        <div class="alert alert-success fs-10 mb-3">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger fs-10 mb-3">{{ session('error') }}</div>
    @endif

    {{-- Balance card --}}
    <div class="on-card text-center">
        <p class="on-stat-label mb-2">Available Balance &middot; USD</p>
        <p class="on-stat-value" style="font-size:2.5rem;">${{ number_format($balance, 2) }}</p>
        <p class="mt-3 mb-0">
            <a href="{{ route('user.redemption-history') }}" class="on-text-link fs-10">View withdrawal history</a>
        </p>
    </div>

    {{-- Linked wallet --}}
    <div class="on-card">
        <p class="on-card-title">Withdraw To</p>
        @if ($linkedWallet)
            <div class="on-def-row">
                <span class="on-def-label">Wallet Address</span>
                <span class="on-def-value text-break">{{ $linkedWallet->vallet_address }}</span>
            </div>
            <div class="on-def-row">
                <span class="on-def-label">Type / Network</span>
                <span class="on-def-value">{{ $linkedWallet->type }}</span>
            </div>
            <div class="on-def-row">
                <span class="on-def-label">Phone</span>
                <span class="on-def-value">{{ $linkedWallet->phone }}</span>
            </div>
        @else
            <p class="fs-10 text-body-tertiary mb-2">
                No wallet linked yet. Withdrawals are paid to your linked wallet.
            </p>
            <a href="{{ route('user.wallet') }}" class="on-text-link fs-10">Link a wallet now &rarr;</a>
        @endif
    </div>

    {{-- Withdrawal form --}}
    <div class="on-card">
        <p class="on-card-title">Request a Withdrawal</p>

        <form method="POST" action="{{ route('user.redemption.store') }}">
            @csrf

            <div class="mb-4">
                <label class="on-field-label" for="withdrawAmount">Withdrawal Amount</label>
                <input type="number"
                       id="withdrawAmount"
                       name="amount"
                       class="form-control @error('amount') is-invalid @enderror"
                       placeholder="Min ${{ number_format($minWithdraw, 2) }} — Max ${{ number_format($maxWithdraw, 2) }}"
                       min="{{ $minWithdraw }}"
                       max="{{ $maxWithdraw }}"
                       step="0.01"
                       value="{{ old('amount') }}"
                       required>
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="on-field-label" for="walletPassword">Wallet Password</label>
                <input type="password"
                       id="walletPassword"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Enter your wallet password"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark py-3">Request Withdrawal</button>
            </div>
        </form>
    </div>

</div>

@endsection
