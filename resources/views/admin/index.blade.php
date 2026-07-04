@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">

        {{-- BREADCRUMB --}}
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Dashboard</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            {{-- ══════════════════════════════════════════════════════
                 TOP STAT CARDS
            ═══════════════════════════════════════════════════════ --}}
            <div class="card-group">

                {{-- New Clients --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <i class="mdi mdi-emoticon font-20 text-muted"></i>
                                        <p class="font-16 m-b-5">New Clients</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h1 class="font-light text-right">{{ $newClients }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar"
                                         style="width: {{ $newClientsPercent }}%; height: 6px;"
                                         aria-valuenow="{{ $newClientsPercent }}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Active Order Lists --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <i class="mdi mdi-image font-20 text-muted"></i>
                                        <p class="font-16 m-b-5">Active Order Lists</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h1 class="font-light text-right">{{ $activeOrderLists }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                         style="width: {{ $activeOrderListsPercent }}%; height: 6px;"
                                         aria-valuenow="{{ $activeOrderListsPercent }}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- New Orders (30 days) --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <i class="mdi mdi-currency-eur font-20 text-muted"></i>
                                        <p class="font-16 m-b-5">New Orders (30d)</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h1 class="font-light text-right">{{ $newInvoices }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-purple" role="progressbar"
                                         style="width: {{ $newInvoicesPercent }}%; height: 6px;"
                                         aria-valuenow="{{ $newInvoicesPercent }}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Active Orders --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <i class="mdi mdi-poll font-20 text-muted"></i>
                                        <p class="font-16 m-b-5">Active Orders</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h1 class="font-light text-right">{{ $totalActiveOrders }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                         style="width: {{ $totalSalesPercent }}%; height: 6px;"
                                         aria-valuenow="{{ $totalSalesPercent }}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ══════════════════════════════════════════════════════
                 MIDDLE ROW: Financial Summary | Weekly Sales | Users
            ═══════════════════════════════════════════════════════ --}}
            <div class="row">

                {{-- LEFT: Financial Summary + Available Balance --}}
                <div class="col-lg-3 col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Financial Summary</h4>
                            <div class="row text-center text-lg-left m-t-10">
                                <div class="col-4">
                                    <h4 class="m-b-0 font-medium text-success">
                                        ${{ number_format($totalDeposits, 0) }}
                                    </h4>
                                    <span class="text-muted">Deposits</span>
                                </div>
                                <div class="col-4">
                                    <h4 class="m-b-0 font-medium text-info">
                                        ${{ number_format($totalCommission, 0) }}
                                    </h4>
                                    <span class="text-muted">Commission</span>
                                </div>
                                <div class="col-4">
                                    <h4 class="m-b-0 font-medium text-danger">
                                        ${{ number_format($totalWithdrawals, 0) }}
                                    </h4>
                                    <span class="text-muted">Withdrawn</span>
                                </div>
                            </div>
                            @if ($pendingRechargeCount > 0 || $pendingWithdrawalCount > 0)
                                <hr class="m-t-15 m-b-10">
                                <div class="row text-center text-lg-left">
                                    <div class="col-6">
                                        <span class="label label-warning label-rounded">
                                            {{ $pendingRechargeCount }}
                                        </span>
                                        <span class="text-muted font-12"> Pending Recharge</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="label label-danger label-rounded">
                                            {{ $pendingWithdrawalCount }}
                                        </span>
                                        <span class="text-muted font-12"> Pending Withdrawal</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title m-b-5">Available Balance</h5>
                            <h3 class="font-light text-success">
                                ${{ number_format($availableBalance, 2) }}
                            </h3>
                            <div class="m-t-10">
                                <p class="text-muted font-12 m-b-0">
                                    Approved Deposits: ${{ number_format($approvedDeposits, 2) }}<br>
                                    Commissions: ${{ number_format($totalCommission, 2) }}<br>
                                    Withdrawals: ${{ number_format($totalWithdrawals, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- CENTER: Sales Ratio + Membership Distribution --}}
                <div class="col-lg-6 col-md-12 order-lg-2 order-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Sales Ratio</h4>
                                </div>
                                <div class="ml-auto">
                                    <span class="text-muted font-12">Week over Week</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center no-block">
                                <div>
                                    <span class="text-muted">This Week</span>
                                    <h3 class="mb-0 text-info font-light">
                                        ${{ number_format($thisWeekSales, 2) }}
                                        <span class="text-muted font-12">
                                            @if ($weeklyDirection === 'up')
                                                <i class="mdi mdi-arrow-up text-success"></i>
                                                +{{ $weeklyChangePercent }}%
                                            @else
                                                <i class="mdi mdi-arrow-down text-danger"></i>
                                                {{ $weeklyChangePercent }}%
                                            @endif
                                        </span>
                                    </h3>
                                </div>
                                <div class="ml-4">
                                    <span class="text-muted">Last Week</span>
                                    <h3 class="mb-0 text-muted font-light">
                                        ${{ number_format($lastWeekSales, 2) }}
                                    </h3>
                                </div>
                            </div>

                            <p class="text-muted font-14 m-t-20">
                                New order value (last 30 days):
                                <strong class="text-dark">${{ number_format($newSalesValue, 2) }}</strong>
                            </p>

                            {{-- Membership distribution bars --}}
                            <h6 class="font-medium text-muted m-b-10 m-t-15">Members by Level</h6>
                            @foreach ($membershipStats as $mem)
                                @php
                                    $pct = $totalUsers > 0
                                        ? min(round(($mem->users_count / $totalUsers) * 100), 100)
                                        : 0;
                                @endphp
                                <div class="d-flex align-items-center m-b-5">
                                    <span class="font-12 text-muted" style="width:80px;">
                                        {{ $mem->level_name }}
                                    </span>
                                    <div class="progress flex-fill m-l-10" style="height:8px;">
                                        <div class="progress-bar bg-info" style="width:{{ $pct }}%"></div>
                                    </div>
                                    <span class="font-12 text-muted m-l-10">{{ $mem->users_count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Pending Actions + Users Card --}}
                <div class="col-lg-3 col-md-6 order-lg-3 order-md-2">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                Pending Actions
                                <span class="font-14 font-normal text-muted">
                                    {{ now()->format('D, d M Y') }}
                                </span>
                            </h4>
                            <div class="m-t-20">
                                <div class="d-flex align-items-center m-b-10">
                                    <i class="mdi mdi-bank font-20 text-warning m-r-10"></i>
                                    <div>
                                        <h5 class="m-b-0 font-medium">{{ $pendingRechargeCount }}</h5>
                                        <span class="text-muted font-12">Pending Recharges</span>
                                    </div>
                                    <div class="ml-auto text-warning font-medium">
                                        ${{ number_format($pendingRechargeAmount, 2) }}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-cash-multiple font-20 text-danger m-r-10"></i>
                                    <div>
                                        <h5 class="m-b-0 font-medium">{{ $pendingWithdrawalCount }}</h5>
                                        <span class="text-muted font-12">Pending Withdrawals</span>
                                    </div>
                                    <div class="ml-auto text-danger font-medium">
                                        ${{ number_format($pendingWithdrawalAmount, 2) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title m-b-0">
                                Users
                                <span class="font-16 text-success font-medium">
                                    +{{ $newUsersPercent }}%
                                </span>
                            </h4>
                            <h2 class="font-light">{{ number_format($totalUsers) }}</h2>
                            <div class="m-t-30">
                                <div class="row text-center">
                                    <div class="col-6 border-right">
                                        <h4 class="m-b-0">{{ $newUsersPercent }}%</h4>
                                        <span class="font-14 text-muted">New (30d)</span>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="m-b-0">{{ $repeatUsersPercent }}%</h4>
                                        <span class="font-14 text-muted">Existing</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            {{-- / MIDDLE ROW --}}

            {{-- ══════════════════════════════════════════════════════
                 BOTTOM ROW 1: Recent Orders | Membership Table
            ═══════════════════════════════════════════════════════ --}}
            <div class="row">

                {{-- Recent Orders (replaces "Latest Sales") --}}
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="card-title mb-0">Latest Orders</h4>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('admin.orders') }}"
                                       class="btn btn-sm btn-outline-primary">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row align-items-center">
                                <div class="col-xs-12 col-md-6">
                                    <h3 class="m-b-0 font-light">Last 30 Days</h3>
                                    <span class="font-14 text-muted">Order Activity</span>
                                </div>
                                <div class="col-xs-12 col-md-6 align-self-center display-6 text-info text-right">
                                    ${{ number_format($newSalesValue, 2) }}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">ORDER</th>
                                        <th class="border-top-0">USER</th>
                                        <th class="border-top-0">STATUS</th>
                                        <th class="border-top-0">DATE</th>
                                        <th class="border-top-0">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentOrders as $order)
                                        <tr>
                                            <td class="txt-oflo">
                                                {{ $order->orderList->title ?? 'Order #' . $order->id }}
                                            </td>
                                            <td class="txt-oflo">
                                                {{ optional($order->user)->name ?? '—' }}
                                            </td>
                                            <td>
                                                @if ($order->type === 'Complete')
                                                    <span class="label label-success label-rounded">Done</span>
                                                @elseif ($order->type === 'Incomplete')
                                                    <span class="label label-warning label-rounded">Pending</span>
                                                @else
                                                    <span class="label label-default label-rounded">
                                                        {{ ucfirst($order->type ?? 'N/A') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="txt-oflo">
                                                {{ $order->created_at->format('M j, Y') }}
                                            </td>
                                            <td>
                                                <span class="font-medium">
                                                    ${{ number_format($order->total_amount, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-3">
                                                No orders found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Membership Breakdown (replaces "Top Region Sales") --}}
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="card-title m-b-0">Membership Breakdown</h4>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('admin.memberships.index') }}"
                                       class="btn btn-sm btn-outline-primary">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">LEVEL</th>
                                        <th class="border-top-0">MEMBERS</th>
                                        <th class="border-top-0">LIMIT/DAY</th>
                                        <th class="border-top-0">COMMISSION</th>
                                        <th class="border-top-0">SHARE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($membershipStats as $mem)
                                        @php
                                            $share = $totalUsers > 0
                                                ? round(($mem->users_count / $totalUsers) * 100, 1)
                                                : 0;
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $mem->level_name }}</strong></td>
                                            <td>
                                                <span class="label label-primary label-rounded">
                                                    {{ $mem->users_count }}
                                                </span>
                                            </td>
                                            <td>{{ $mem->order_limit }}</td>
                                            <td>{{ $mem->commission }}%</td>
                                            <td>
                                                <div class="progress" style="height:6px;min-width:60px;">
                                                    <div class="progress-bar bg-info"
                                                         style="width:{{ $share }}%"></div>
                                                </div>
                                                <small class="text-muted">{{ $share }}%</small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-3">
                                                No membership levels defined.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row m-t-10 text-center">
                                <div class="col-xs-12 col-md-4">
                                    <div class="mb-2 mt-2">
                                        <span class="label label-success label-rounded">
                                            ${{ number_format($totalDeposits, 0) }}
                                        </span>
                                        <h5 class="font-normal text-muted m-t-10 m-b-5">Total Deposits</h5>
                                        <span class="font-14 font-medium">
                                            {{ $pendingRechargeCount }} pending
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="mb-2 mt-2">
                                        <span class="label label-info label-rounded">
                                            ${{ number_format($totalCommission, 0) }}
                                        </span>
                                        <h5 class="font-normal text-muted m-t-10 m-b-5">Commission</h5>
                                        <span class="font-14 font-medium">Earned total</span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="mb-2 mt-2">
                                        <span class="label label-danger label-rounded">
                                            ${{ number_format($totalWithdrawals, 0) }}
                                        </span>
                                        <h5 class="font-normal text-muted m-t-10 m-b-5">Withdrawn</h5>
                                        <span class="font-14 font-medium">
                                            {{ $pendingWithdrawalCount }} pending
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- / BOTTOM ROW 1 --}}

            {{-- ══════════════════════════════════════════════════════
                 BOTTOM ROW 2: Recent Members | Pending Requests
            ═══════════════════════════════════════════════════════ --}}
            <div class="row">

                {{-- Recent Members (replaces "Recent Comments") --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Members</h4>
                        </div>
                        <div class="comment-widgets scrollable" style="height:330px;">
                            @forelse ($recentUsers as $u)
                                <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="p-2">
                                        <div style="width:46px;height:46px;border-radius:50%;
                                                    background:linear-gradient(135deg,#6c47ff,#00bcd4);
                                                    display:flex;align-items:center;justify-content:center;
                                                    color:#fff;font-size:18px;font-weight:700;flex-shrink:0;">
                                            {{ strtoupper(substr($u->name ?? 'U', 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{ $u->name }}</h6>
                                        <span class="m-b-15 d-block text-muted">
                                            {{ $u->email }}
                                            @if ($u->phone)
                                                &nbsp;·&nbsp; {{ $u->phone }}
                                            @endif
                                        </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right">
                                                {{ $u->created_at->diffForHumans() }}
                                            </span>
                                            @if ($u->membershipLevel)
                                                <span class="label label-rounded label-primary">
                                                    {{ $u->membershipLevel->level_name }}
                                                </span>
                                            @endif
                                            <span class="label label-rounded {{ $u->status === 'active' ? 'label-success' : 'label-danger' }}">
                                                {{ ucfirst($u->status ?? 'inactive') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center text-muted">No members registered yet.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Pending Requests (replaces "To Do List") --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center p-b-15">
                                <div>
                                    <h4 class="card-title m-b-0">Pending Requests &amp; Summary</h4>
                                </div>
                                <div class="ml-auto">
                                    <span class="text-muted font-12">{{ now()->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="todo-widget scrollable" style="height:282px;">
                                <ul class="list-task todo-list list-group m-b-0">

                                    {{-- Pending recharges --}}
                                    <li class="list-group-item todo-item">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-fill">
                                                <span class="todo-desc">
                                                    @if ($pendingRechargeCount > 0)
                                                        <strong>{{ $pendingRechargeCount }}</strong>
                                                        pending recharge request{{ $pendingRechargeCount > 1 ? 's' : '' }}
                                                        — total
                                                        <strong>${{ number_format($pendingRechargeAmount, 2) }}</strong>
                                                    @else
                                                        ✓ No pending recharge requests
                                                    @endif
                                                </span>
                                            </div>
                                            <span class="badge badge-pill {{ $pendingRechargeCount > 0 ? 'badge-warning' : 'badge-success' }} float-right">
                                                Recharge
                                            </span>
                                        </div>
                                    </li>

                                    {{-- Pending withdrawals --}}
                                    <li class="list-group-item todo-item">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-fill">
                                                <span class="todo-desc">
                                                    @if ($pendingWithdrawalCount > 0)
                                                        <strong>{{ $pendingWithdrawalCount }}</strong>
                                                        pending withdrawal{{ $pendingWithdrawalCount > 1 ? 's' : '' }}
                                                        — total
                                                        <strong>${{ number_format($pendingWithdrawalAmount, 2) }}</strong>
                                                    @else
                                                        ✓ No pending withdrawal requests
                                                    @endif
                                                </span>
                                            </div>
                                            <span class="badge badge-pill {{ $pendingWithdrawalCount > 0 ? 'badge-danger' : 'badge-success' }} float-right">
                                                Withdrawal
                                            </span>
                                        </div>
                                    </li>

                                    {{-- Platform stats --}}
                                    <li class="list-group-item todo-item">
                                        <span class="todo-desc">
                                            Total registered users:
                                            <strong>{{ number_format($totalUsers) }}</strong>
                                        </span>
                                        <span class="badge badge-pill badge-info float-right">Users</span>
                                    </li>

                                    <li class="list-group-item todo-item">
                                        <span class="todo-desc">
                                            Active order lists available:
                                            <strong>{{ $activeOrderLists }}</strong>
                                        </span>
                                        <span class="badge badge-pill badge-primary float-right">Orders</span>
                                    </li>

                                    <li class="list-group-item todo-item">
                                        <span class="todo-desc">
                                            New members in last 30 days:
                                            <strong>{{ $newClients }}</strong>
                                        </span>
                                        <span class="badge badge-pill badge-success float-right">Growth</span>
                                    </li>

                                    <li class="list-group-item todo-item">
                                        <span class="todo-desc">
                                            Platform available balance:
                                            <strong>${{ number_format($availableBalance, 2) }}</strong>
                                        </span>
                                        <span class="badge badge-pill badge-purple float-right">Finance</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- / BOTTOM ROW 2 --}}

        </div>
        {{-- / container-fluid --}}

    </div>
    {{-- / page-wrapper --}}

@endsection
