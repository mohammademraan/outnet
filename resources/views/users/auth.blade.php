@extends('users.layouts.master')

@section('content')

@php
  // Mode: 'login' or 'register'. A failed POST redirects back with old('_form'),
  // which must win over the route default so the user sees the form they submitted.
  $mode = old('_form', $mode ?? 'login');
@endphp

<div class="on-page on-auth">

    {{-- Heading --}}
    <div class="on-auth-head">
        <h1 class="on-auth-title" id="on-auth-title">
            {{ $mode === 'register' ? 'Register now' : 'Welcome' }}
        </h1>
    </div>

    <div class="on-auth-body">

        {{-- Mode toggle --}}
        <div class="on-auth-toggle">
            <label class="on-radio">
                <input type="radio" name="auth-mode" value="login" {{ $mode === 'login' ? 'checked' : '' }}>
                <span class="on-radio-mark"></span>
                I&rsquo;m already registered
            </label>
            <label class="on-radio">
                <input type="radio" name="auth-mode" value="register" {{ $mode === 'register' ? 'checked' : '' }}>
                <span class="on-radio-mark"></span>
                I&rsquo;m new to THE OUTNET
            </label>
        </div>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger fs-10 mb-4">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success fs-10 mb-4">{{ session('success') }}</div>
        @endif

        {{-- ════════ Sign-in form ════════ --}}
        <form id="on-form-login" method="POST" action="{{ route('login') }}"
              class="{{ $mode === 'register' ? 'd-none' : '' }}">
            @csrf
            <input type="hidden" name="_form" value="login">

            <div class="on-auth-field">
                <label for="li-email">Email Address</label>
                <input type="text" id="li-email" name="email"
                       value="{{ old('_form') === 'login' ? old('email') : '' }}"
                       autocomplete="username" required>
            </div>

            <div class="on-auth-field">
                <label for="li-password">Password</label>
                <div class="on-auth-pw">
                    <button type="button" class="on-eye" tabindex="-1" aria-label="Show password">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                    <input type="password" id="li-password" name="password"
                           autocomplete="current-password" required>
                </div>
            </div>

            <div class="on-auth-remember">
                <label class="on-radio on-checkbox">
                    <input type="checkbox" name="remember" id="remember">
                    <span class="on-radio-mark"></span>
                    Remember me
                </label>
            </div>

            <button class="on-auth-submit" type="submit">Sign In</button>

            @if (Route::has('password.request'))
                <a class="on-auth-forgot" href="{{ route('password.request') }}">Forgot your password?</a>
            @endif
        </form>

        {{-- ════════ Register form ════════ --}}
        <form id="on-form-register" method="POST" action="{{ route('user-registeration') }}"
              class="{{ $mode === 'register' ? '' : 'd-none' }}">
            @csrf
            <input type="hidden" name="_form" value="register">

            <div class="on-auth-field">
                <label for="rg-email">Email Address</label>
                <input type="email" id="rg-email" name="email"
                       value="{{ old('_form') === 'register' ? old('email') : '' }}" required>
            </div>

            <div class="on-auth-field">
                <label for="rg-password">Create New Password</label>
                <div class="on-auth-pw">
                    <button type="button" class="on-eye" tabindex="-1" aria-label="Show password">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                    <input type="password" id="rg-password" name="password" autocomplete="new-password" required>
                </div>
                <p class="on-auth-hint">Your password must be eight characters or more</p>
            </div>

            <div class="on-auth-field">
                <label for="rg-password-confirm">Confirm Password</label>
                <div class="on-auth-pw">
                    <button type="button" class="on-eye" tabindex="-1" aria-label="Show password">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                    <input type="password" id="rg-password-confirm" name="password_confirmation"
                           autocomplete="new-password" required>
                </div>
            </div>

            <div class="on-auth-field">
                <label for="rg-name">Full Name</label>
                <input type="text" id="rg-name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="on-auth-field">
                <label for="rg-phone">Phone Number</label>
                <input type="text" id="rg-phone" name="phone" value="{{ old('phone') }}" required>
            </div>

            <div class="on-auth-field">
                <label for="rg-wallet-password">Wallet Password</label>
                <div class="on-auth-pw">
                    <button type="button" class="on-eye" tabindex="-1" aria-label="Show password">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                    <input type="password" id="rg-wallet-password" name="wallet-password" required>
                </div>
                <p class="on-auth-hint">Used to authorize withdrawals &mdash; keep it different from your account password</p>
            </div>

            <div class="on-auth-field">
                <label for="rg-reference">Reference Code</label>
                <input type="text" id="rg-reference" name="refrence-code" value="{{ old('refrence-code') }}" required>
            </div>

            <p class="on-auth-terms">
                By registering you accept you have read and understood THE OUTNET
                <a href="{{ route('users.privacy') }}">Account Terms and Conditions</a> and
                <a href="{{ route('users.privacy') }}">Privacy Policy</a>.
            </p>

            <p class="on-auth-terms">
                By clicking Register, you agree to join our Rewards Programme as regulated
                under these <a href="{{ route('users.privacy') }}">Terms and Conditions</a> and
                enjoy the additional benefits listed in
                <a href="{{ route('users.privacy') }}">My Account Terms and Conditions</a>.
            </p>

            <button class="on-auth-submit" type="submit">Register</button>
        </form>

    </div>
</div>

<script>
(function () {
    var radios   = document.querySelectorAll('input[name="auth-mode"]');
    var title    = document.getElementById('on-auth-title');
    var loginF   = document.getElementById('on-form-login');
    var registerF = document.getElementById('on-form-register');

    radios.forEach(function (r) {
        r.addEventListener('change', function () {
            var isRegister = this.value === 'register';
            loginF.classList.toggle('d-none', isRegister);
            registerF.classList.toggle('d-none', !isRegister);
            title.textContent = isRegister ? 'Register now' : 'Welcome';
            if (window.history && history.replaceState) {
                history.replaceState(null, '', isRegister ? '{{ route('register') }}' : '{{ route('user.login') }}');
            }
        });
    });

    /* Password visibility toggles */
    document.querySelectorAll('.on-eye').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = this.parentNode.querySelector('input');
            var icon  = this.querySelector('i');
            var show  = input.type === 'password';
            input.type = show ? 'text' : 'password';
            icon.className = show ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    });
})();
</script>

@endsection
