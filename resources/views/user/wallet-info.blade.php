@extends('users.layouts.master')

@section('content')

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Your Funds</p>
        <h1 class="on-form-heading">{{ isset($wallet) && $wallet ? 'Wallet' : 'Link Wallet' }}</h1>
    </div>

    {{-- Session alerts --}}
    @if (session('success'))
        <div class="alert alert-success fs-10 mb-3">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger fs-10 mb-3">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if (isset($wallet) && $wallet)

        {{-- Already linked — show details --}}
        <div class="on-card">
            <div class="d-flex justify-content-between align-items-baseline mb-3">
                <p class="on-card-title mb-0 pb-0 border-0">Linked Wallet</p>
                <span class="on-status on-status-completed">Active</span>
            </div>

            <div class="on-def-row">
                <span class="on-def-label">Wallet Address</span>
                <span class="on-def-value text-break">
                    <span id="linked-addr">{{ $wallet->vallet_address }}</span>
                    <button type="button"
                            class="btn btn-link p-0 ms-2 text-body-tertiary fs-10 align-baseline"
                            onclick="navigator.clipboard.writeText(document.getElementById('linked-addr').innerText);this.innerHTML='<i class=\'fas fa-check\'></i>';">
                        <i class="fas fa-copy"></i>
                    </button>
                </span>
            </div>
            <div class="on-def-row">
                <span class="on-def-label">Type / Network</span>
                <span class="on-def-value">{{ $wallet->type }}</span>
            </div>
            <div class="on-def-row">
                <span class="on-def-label">Phone</span>
                <span class="on-def-value">{{ $wallet->phone }}</span>
            </div>

            <p class="fs-10 text-body-tertiary mt-3 mb-0 text-center">
                <span class="fas fa-lock me-1"></span>
                Wallet details are locked. Contact support to update your linked wallet.
            </p>
        </div>

        <div class="row g-2 mt-3">
            <div class="col-6">
                <a href="{{ route('user.recharge') }}" class="btn btn-dark w-100 py-3">Deposit</a>
            </div>
            <div class="col-6">
                <a href="{{ route('user.redemption') }}" class="btn btn-outline-dark w-100 py-3">Withdraw</a>
            </div>
        </div>

    @else

        {{-- Link wallet form --}}
        <div class="on-card">
            <p class="on-card-title">Link Your Wallet</p>

            <form method="POST" action="{{ route('wallet-information.save') }}">
                @csrf

                <div class="mb-4">
                    <label class="on-field-label">Full Name</label>
                    <input type="text" class="form-control"
                           value="{{ auth()->user()->name }}" readonly>
                </div>

                <div class="mb-4">
                    <label class="on-field-label" for="wallet-phone">Phone Number</label>
                    <input type="tel" id="wallet-phone" name="phone-number"
                           class="form-control @error('phone-number') is-invalid @enderror"
                           value="{{ old('phone-number') }}" required>
                    @error('phone-number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="on-field-label" for="wallet-address-input">Wallet Address</label>
                    <div class="d-flex gap-2 align-items-end">
                        <input type="text" id="wallet-address-input" name="vallet-address"
                               class="form-control @error('vallet-address') is-invalid @enderror"
                               value="{{ old('vallet-address') }}" required>
                        <button type="button"
                                class="btn btn-outline-dark btn-sm px-3 flex-shrink-0"
                                onclick="navigator.clipboard.readText().then(function(t){document.getElementById('wallet-address-input').value=t;});">
                            Paste
                        </button>
                    </div>
                    @error('vallet-address')
                        <div class="text-danger fs-10 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="on-field-label">Currency</label>
                    <div class="d-flex gap-3 flex-wrap">
                        @foreach (['USDT', 'USDC', 'ETH', 'BTC'] as $cur)
                            <label class="on-radio mb-0">
                                <input type="radio" name="currency" value="{{ $cur }}"
                                       {{ $cur === 'USDT' ? 'checked' : '' }}>
                                <span class="on-radio-mark"></span>
                                {{ $cur }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <label class="on-field-label">Network</label>
                    <div class="d-flex gap-3 flex-wrap">
                        @foreach (['TRC20', 'ERC20', 'BTC'] as $net)
                            <label class="on-radio mb-0">
                                <input type="radio" name="wallet-type" value="{{ $net }}"
                                       {{ ($net === 'TRC20' || old('wallet-type') === $net) ? 'checked' : '' }} required>
                                <span class="on-radio-mark"></span>
                                {{ $net }}
                            </label>
                        @endforeach
                    </div>
                    @error('wallet-type')
                        <div class="text-danger fs-10 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-dark py-3">Link Wallet</button>
                </div>
            </form>
        </div>

    @endif

</div>

@endsection
