@extends('users.layouts.master')

@section('content')

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Action Required</p>
        <h1 class="on-form-heading">Pending Order</h1>
    </div>

    <div class="on-card text-center mx-auto" style="max-width:520px;">
        <span class="fas fa-exclamation-triangle fa-2x text-warning mb-3 d-block"></span>

        <p class="fs-10 text-body-tertiary mb-4">
            {{ $message ?? 'Please complete your current pending order before proceeding.' }}
        </p>

        <hr class="on-hairline my-4">

        <p class="fs-10 text-body-tertiary mb-4">
            Redirecting in <span id="countdown" class="fw-bold text-black">4</span> seconds&hellip;
        </p>

        <div class="d-grid">
            <a href="{{ $redirect_url ?? route('history') }}" class="btn btn-dark py-3">
                View Pending Order
            </a>
        </div>
    </div>

</div>

<script>
    (function () {
        var seconds = 4;
        var el = document.getElementById('countdown');
        var interval = setInterval(function () {
            seconds--;
            if (el) el.textContent = seconds;
            if (seconds <= 0) {
                clearInterval(interval);
                window.location.href = '{{ $redirect_url ?? route("history") }}';
            }
        }, 1000);
    })();
</script>

@endsection
