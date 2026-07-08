@extends('users.layouts.master')

@section('content')

@php
  $completed     = $completedOrders    ?? collect();
  $onHold        = $onHoldOrders       ?? collect();
  $oneIncomplete = $oneIncompleteOrder ?? null;
  $membershipObj = $membership         ?? null;
  $commRate      = ($membershipObj->commission ?? 0) / 100;
  $userFunds     = $funds              ?? 0;

  $pendingCount   = $oneIncomplete ? 1 : 0;
  $completedCount = count($completed);
  $allCount       = $pendingCount + $completedCount;
@endphp

<div class="on-page">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Your Activity</p>
        <h1 class="on-form-heading">Evaluation History</h1>
    </div>

    {{-- Pending deposits notice --}}
    @if (($pendingDeposits ?? 0) > 0)
        <div class="alert alert-warning fs-10 mb-4 text-center">
            You have ${{ number_format($pendingDeposits, 2) }} in deposits awaiting admin approval.
            Pending funds are not part of your usable balance until approved.
        </div>
    @endif

    {{-- Underline tabs --}}
    <ul class="on-tabs justify-content-center nav" id="historyTabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="pill" href="#tk-all">All ({{ $allCount }})</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#tk-pending">Pending ({{ $pendingCount }})</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#tk-completed">Completed ({{ $completedCount }})</a>
        </li>
    </ul>

    {{-- Tab panes --}}
    <div class="tab-content">

        {{-- ── ALL ─────────────────────────────────────────────── --}}
        <div class="tab-pane fade show active" id="tk-all">

            @if ($allCount === 0)
                <div class="text-center py-6">
                    <span class="fas fa-inbox fa-2x text-body-tertiary mb-3 d-block"></span>
                    <p class="text-body-tertiary fs-10 mb-4">No evaluations yet. Start your first evaluation now.</p>
                    <a href="{{ route('generate.order') }}" class="btn btn-dark px-5">Start Evaluating</a>
                </div>
            @endif

            @if ($oneIncomplete)
                @php
                    $price = $oneIncomplete->orderList->price ?? 0;
                    $comm  = $oneIncomplete->commission_amount ?? round($price * $commRate, 2);
                @endphp
                <div class="on-order-row">
                    @if (!empty($oneIncomplete->orderList->image))
                        <img src="{{ asset('OrderImages/' . $oneIncomplete->orderList->image) }}"
                             alt="{{ $oneIncomplete->orderList->title }}" />
                    @else
                        <div class="on-order-thumb"><span class="fas fa-image"></span></div>
                    @endif
                    <div class="on-order-body">
                        <span class="on-status on-status-pending">Pending</span>
                        <p class="on-order-title">{{ $oneIncomplete->orderList->title ?? 'Task' }}</p>
                        <p class="on-order-meta">
                            {{ $oneIncomplete->created_at->format('d/m/y, H:i') }}
                            &middot; Value ${{ number_format($price, 2) }}
                            &middot; Commission ${{ number_format($comm, 2) }}
                        </p>
                    </div>
                    @if ($oneIncomplete->orderList->price > $userFunds)
                        <a href="{{ route('user.recharge') }}" class="btn btn-outline-dark btn-sm px-4">Recharge to Submit</a>
                    @else
                        <form method="POST" action="{{ route('submit.order') }}">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $oneIncomplete->order_id }}">
                            <input type="hidden" name="commission" value="{{ $comm }}">
                            <button type="submit" class="btn btn-dark btn-sm px-4">Submit</button>
                        </form>
                    @endif
                </div>
            @endif

            @foreach ($completed as $task)
                @php
                    $price = $task['price']      ?? 0;
                    $comm  = $task['commission'] ?? 0;
                @endphp
                <div class="on-order-row">
                    @if (!empty($task['image']))
                        <img src="{{ asset('OrderImages/' . $task['image']) }}" alt="{{ $task['title'] }}" />
                    @else
                        <div class="on-order-thumb"><span class="fas fa-image"></span></div>
                    @endif
                    <div class="on-order-body">
                        <span class="on-status on-status-completed">Completed</span>
                        <p class="on-order-title">{{ $task['title'] ?? 'Task' }}</p>
                        <p class="on-order-meta">
                            {{ $task['created_at'] ?? '—' }}
                            &middot; Value ${{ number_format($price, 2) }}
                        </p>
                    </div>
                    <span class="on-order-amount">+${{ number_format($comm, 2) }}</span>
                </div>
            @endforeach

        </div>

        {{-- ── PENDING ──────────────────────────────────────────── --}}
        <div class="tab-pane fade" id="tk-pending">
            @if ($oneIncomplete)
                @php
                    $price = $oneIncomplete->orderList->price ?? 0;
                    $comm  = $price * $commRate;
                @endphp
                <div class="on-order-row">
                    @if (!empty($oneIncomplete->orderList->image))
                        <img src="{{ asset('OrderImages/' . $oneIncomplete->orderList->image) }}"
                             alt="{{ $oneIncomplete->orderList->title }}" />
                    @else
                        <div class="on-order-thumb"><span class="fas fa-image"></span></div>
                    @endif
                    <div class="on-order-body">
                        <span class="on-status on-status-pending">Pending</span>
                        <p class="on-order-title">{{ $oneIncomplete->orderList->title ?? 'Task' }}</p>
                        <p class="on-order-meta">
                            {{ $oneIncomplete->created_at->format('d/m/y, H:i') }}
                            &middot; Value ${{ number_format($price, 2) }}
                            &middot; Commission ${{ number_format($comm, 2) }}
                        </p>
                    </div>
                    @if ($oneIncomplete->orderList->price > $userFunds)
                        <a href="{{ route('user.recharge') }}" class="btn btn-outline-dark btn-sm px-4">Recharge to Submit</a>
                    @else
                        <form method="POST" action="{{ route('submit.order') }}">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $oneIncomplete->order_id }}">
                            <input type="hidden" name="commission" value="{{ $comm }}">
                            <button type="submit" class="btn btn-dark btn-sm px-4">Submit</button>
                        </form>
                    @endif
                </div>
            @else
                <div class="text-center py-6">
                    <span class="fas fa-check-circle fa-2x text-body-tertiary mb-3 d-block"></span>
                    <p class="text-body-tertiary fs-10 mb-0">No pending evaluations.</p>
                </div>
            @endif
        </div>

        {{-- ── COMPLETED ────────────────────────────────────────── --}}
        <div class="tab-pane fade" id="tk-completed">
            @forelse ($completed as $task)
                @php
                    $price = $task['price']      ?? 0;
                    $comm  = $task['commission'] ?? 0;
                @endphp
                <div class="on-order-row">
                    @if (!empty($task['image']))
                        <img src="{{ asset('OrderImages/' . $task['image']) }}" alt="{{ $task['title'] }}" />
                    @else
                        <div class="on-order-thumb"><span class="fas fa-image"></span></div>
                    @endif
                    <div class="on-order-body">
                        <span class="on-status on-status-completed">Completed</span>
                        <p class="on-order-title">{{ $task['title'] ?? 'Task' }}</p>
                        <p class="on-order-meta">
                            {{ $task['created_at'] ?? '—' }}
                            &middot; Value ${{ number_format($price, 2) }}
                        </p>
                    </div>
                    <span class="on-order-amount">+${{ number_format($comm, 2) }}</span>
                </div>
            @empty
                <div class="text-center py-6">
                    <span class="fas fa-history fa-2x text-body-tertiary mb-3 d-block"></span>
                    <p class="text-body-tertiary fs-10 mb-0">No completed evaluations yet.</p>
                </div>
            @endforelse
        </div>

    </div>

</div>

@endsection
