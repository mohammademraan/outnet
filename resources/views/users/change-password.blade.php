@extends('users.layouts.master')

@section('content')

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Account Security</p>
        <h1 class="on-form-heading">Change Password</h1>
    </div>

    {{-- Underline tabs --}}
    <ul class="on-tabs justify-content-center nav" id="pwdTabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="pill" href="#pwd-account">Account Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#pwd-wallet">Wallet Password</a>
        </li>
    </ul>

    <div class="tab-content">

        {{-- ── Account Password ── --}}
        <div class="tab-pane fade show active" id="pwd-account">

            @if (session('pass_status') && old('_form') !== 'wallet')
                <div class="alert alert-success fs-10 mb-3">{{ session('pass_status') }}</div>
            @endif
            @if ($errors->hasAny(['current_password','new_password','new_password_confirmation']) && old('_form') !== 'wallet')
                <div class="alert alert-danger fs-10 mb-3">Please fix the errors below.</div>
            @endif

            <div class="on-card">
                <form method="POST" action="{{ route('user.password.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_form" value="account">

                    <div class="mb-4">
                        <label class="on-field-label">Current Password</label>
                        <input type="password" name="current_password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               placeholder="Enter current password"
                               autocomplete="current-password">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="on-field-label">New Password</label>
                        <input type="password" name="new_password"
                               class="form-control @error('new_password') is-invalid @enderror"
                               placeholder="Min. 8 characters"
                               autocomplete="new-password">
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="on-field-label">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation"
                               class="form-control"
                               placeholder="Repeat new password"
                               autocomplete="new-password">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark py-3">Update Account Password</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ── Wallet Password ── --}}
        <div class="tab-pane fade" id="pwd-wallet">

            @if (session('pass_status') && old('_form') === 'wallet')
                <div class="alert alert-success fs-10 mb-3">{{ session('pass_status') }}</div>
            @endif
            @if ($errors->hasAny(['current_wallet_password','new_wallet_password','new_wallet_password_confirmation']))
                <div class="alert alert-danger fs-10 mb-3">Please fix the errors below.</div>
            @endif

            <div class="on-card">
                <p class="fs-10 text-body-tertiary mb-4">
                    Your wallet password is required to authorize all withdrawals.
                    Keep it different from your account password.
                </p>

                <form method="POST" action="{{ route('user.wallet-password.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_form" value="wallet">

                    <div class="mb-4">
                        <label class="on-field-label">Current Wallet Password</label>
                        <input type="password" name="current_wallet_password"
                               class="form-control @error('current_wallet_password') is-invalid @enderror"
                               placeholder="Enter current wallet password"
                               autocomplete="current-password">
                        @error('current_wallet_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="on-field-label">New Wallet Password</label>
                        <input type="password" name="new_wallet_password"
                               class="form-control @error('new_wallet_password') is-invalid @enderror"
                               placeholder="Min. 8 characters"
                               autocomplete="new-password">
                        @error('new_wallet_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="on-field-label">Confirm New Wallet Password</label>
                        <input type="password" name="new_wallet_password_confirmation"
                               class="form-control"
                               placeholder="Repeat new wallet password"
                               autocomplete="new-password">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark py-3">Update Wallet Password</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- Back link --}}
    <div class="text-center mt-4">
        <a href="{{ route('user.profile') }}" class="on-text-link fs-10">&larr; Back to Profile</a>
    </div>

</div>

{{-- Auto-activate wallet tab if wallet errors exist --}}
@if ($errors->hasAny(['current_wallet_password','new_wallet_password','new_wallet_password_confirmation']) || (session('pass_status') && old('_form') === 'wallet'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var walletTab = document.querySelector('[href="#pwd-wallet"]');
            if (walletTab) walletTab.click();
        });
    </script>
@endif

@endsection
