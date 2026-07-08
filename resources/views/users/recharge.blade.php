@extends('users.layouts.master')

@section('content')

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Your Funds</p>
        <h1 class="on-form-heading">Deposit</h1>
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
        <p class="on-stat-label mb-2">Total Balance &middot; USD</p>
        <p class="on-stat-value" style="font-size:2.5rem;">${{ number_format($totalBalance ?? 0, 2) }}</p>
        @if (($pendingDeposit ?? 0) > 0)
            <p class="fs-10 mt-2 mb-0" style="color:#b45309;">
                ${{ number_format($pendingDeposit, 2) }} in deposits awaiting approval &mdash; not yet in your balance
            </p>
        @endif
        <p class="mt-3 mb-0">
            <a href="{{ route('user.recharge-history') }}" class="on-text-link fs-10">View deposit history</a>
        </p>
    </div>

    {{-- Deposit form --}}
    <div class="on-card">
        <p class="on-card-title">Make a Deposit</p>

        <form method="POST" action="{{ route('user.recharge.store') }}">
            @csrf
            <input type="hidden" name="payment_method" value="direct">

            <div class="mb-4">
                <label class="on-field-label" for="depositAmount">Deposit Amount</label>
                <input type="number"
                       id="depositAmount"
                       name="amount"
                       class="form-control @error('amount') is-invalid @enderror"
                       placeholder="Enter the deposit amount"
                       min="10"
                       max="5000"
                       step="0.01"
                       value="{{ old('amount') }}"
                       required>
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Preset amounts --}}
            <div class="row g-2 mb-4">
                @foreach ([50, 100, 300, 1000, 3000] as $preset)
                    <div class="col-4">
                        <button type="button"
                                class="btn btn-outline-dark w-100 fs-10"
                                onclick="document.getElementById('depositAmount').value='{{ $preset }}'">
                            ${{ number_format($preset) }}
                        </button>
                    </div>
                @endforeach
                <div class="col-4">
                    <button type="button"
                            class="btn btn-outline-dark w-100 fs-10"
                            onclick="document.getElementById('depositAmount').value='';document.getElementById('depositAmount').focus();">
                        Other
                    </button>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark py-3">Deposit</button>
            </div>
        </form>
    </div>

</div>

@endsection
