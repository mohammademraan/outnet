@extends('users.layouts.master')

@section('content')

<div class="on-page">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Product Evaluation</p>
        <h1 class="on-form-heading">Today&rsquo;s Evaluation</h1>
    </div>

    @if (session('error'))
        <div class="alert alert-danger fs-10 mb-3">{{ session('error') }}</div>
    @endif

    {{-- Empty state --}}
    @if (!$orderData || count($orderData) === 0)
        <div class="on-card text-center py-6 mx-auto" style="max-width:560px;">
            <p class="text-body-tertiary fs-10 mb-4">No order available at this time.</p>
            <a href="{{ route('user.dashboard') }}" class="btn btn-dark px-4">Back to Dashboard</a>
        </div>

    @else

        @foreach ($orderData as $data)
            @php
                $order        = $data['order'];
                $price        = $data['price'];
                $commission   = $data['commission'];
                $totalValue   = $data['total_value'];
                $image        = $data['image'] ?? null;
                $overpriced   = $data['overpriced_amount'] ?? 0;
                $isOverpriced = $overpriced > 0;
            @endphp

            <div class="row g-4 justify-content-center align-items-start">

                {{-- Left: large editorial product image --}}
                <div class="col-md-6 col-lg-5">
                    @if ($image)
                        <img class="img-fluid w-100"
                             style="aspect-ratio: 4 / 5; object-fit: cover;"
                             src="{{ asset('OrderImages/' . $image) }}"
                             alt="{{ $order->title }}" />
                    @else
                        <div class="d-flex align-items-center justify-content-center w-100"
                             style="aspect-ratio: 4 / 5; background: #f7f7f7;">
                            <span class="fas fa-image fa-3x text-body-tertiary"></span>
                        </div>
                    @endif
                </div>

                {{-- Right: product details --}}
                <div class="col-md-6 col-lg-5">

                    <h2 class="on-form-heading" style="font-size:1.6rem;">{{ $order->title }}</h2>

                    <p class="fs-10 text-body-tertiary mb-3">
                        &#9733; 2.1/5 &middot; Last updated {{ now()->format('m/d/Y') }}
                    </p>

                    @if ($isOverpriced)
                        <div class="alert alert-danger fs-10 mb-3">
                            <strong>Insufficient Balance.</strong>
                            Your account needs an additional
                            <strong>${{ number_format($overpriced, 2) }}</strong>
                            to complete this order. Please recharge first.
                        </div>
                    @endif

                    <div class="on-def-row">
                        <span class="on-def-label">Data Value</span>
                        <span class="on-def-value">${{ number_format($price, 2) }}</span>
                    </div>
                    <div class="on-def-row">
                        <span class="on-def-label">Commission</span>
                        <span class="on-def-value">${{ number_format($commission, 2) }}</span>
                    </div>
                    <div class="on-def-row">
                        <span class="on-def-label">Remaining Evaluations</span>
                        <span class="on-def-value">{{ $tasksRemaining }}</span>
                    </div>

                    <div class="d-grid mt-4">
                        @if ($isOverpriced)
                            <a href="{{ route('user.recharge') }}" class="btn btn-dark py-3">
                                Recharge Account
                            </a>
                        @else
                            <form method="POST" action="{{ route('submit.order') }}">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="commission" value="{{ $commission }}">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-dark py-3">Submit Evaluation</button>
                                </div>
                            </form>
                        @endif
                    </div>

                    <p class="text-center fs-10 text-body-tertiary mt-3 mb-0">
                        <a class="on-text-link" href="{{ route('user.dashboard') }}">Back to Dashboard</a>
                    </p>

                </div>

            </div>

        @endforeach

    @endif

</div>

@endsection
