@extends('users.layouts.master')

@section('content')

@php
  use App\Models\Funds;
  $uid           = auth()->id();
  $totalDeposit  = Funds::where('user_id', $uid)->where('type', 'deposit')->where('status', 'active')->sum('amount');
  $totalApproved = Funds::where('user_id', $uid)->where('type', 'deposit')->where('status', 'active')->sum('amount');
  $totalPending  = Funds::where('user_id', $uid)->where('type', 'deposit')->where('status', 'pending')->sum('amount');
@endphp

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Your Funds</p>
        <h1 class="on-form-heading">Deposit History</h1>
    </div>

    {{-- Stats --}}
    <div class="on-stat-grid mb-4">
        <div class="on-stat">
            <p class="on-stat-label">Total</p>
            <p class="on-stat-value">${{ number_format($totalDeposit, 2) }}</p>
        </div>
        <div class="on-stat">
            <p class="on-stat-label">Approved</p>
            <p class="on-stat-value">${{ number_format($totalApproved, 2) }}</p>
        </div>
        <div class="on-stat">
            <p class="on-stat-label">Pending</p>
            <p class="on-stat-value">${{ number_format($totalPending, 2) }}</p>
        </div>
    </div>

    {{-- Records --}}
    <div class="on-card">
        <div class="d-flex justify-content-between align-items-baseline flex-wrap gap-2 mb-3">
            <p class="on-card-title mb-0 pb-0 border-0">Recent Transactions</p>
            <a href="{{ route('user.recharge') }}" class="btn btn-dark btn-sm px-4">+ Deposit</a>
        </div>

        @forelse ($rechargeHistory as $r)
            @php $status = strtolower($r->status ?? ''); @endphp
            <div class="on-def-row">
                <div>
                    @if ($status === 'active')
                        <span class="badge" style="background:#eef4fb;color:#1a5fa8;">Approved</span>
                    @elseif ($status === 'pending')
                        <span class="badge" style="background:#fdf6e3;color:#b45309;">Pending</span>
                    @else
                        <span class="badge" style="background:#f0f0f0;color:#555;">{{ ucfirst($r->status ?? '—') }}</span>
                    @endif
                    <span class="fs-10 text-body-tertiary d-block mt-1">
                        {{ optional($r->created_at)->format('Y-m-d H:i') ?? '—' }}
                    </span>
                </div>
                <span class="on-order-amount">+${{ number_format($r->amount ?? 0, 2) }}</span>
            </div>
        @empty
            <div class="text-center py-5">
                <span class="fas fa-inbox fa-2x text-body-tertiary d-block mb-2"></span>
                <p class="fs-10 text-body-tertiary mb-0">No deposit records yet.</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
