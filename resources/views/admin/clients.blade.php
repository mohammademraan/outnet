@extends('admin.layouts.master')

@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Client List</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Clients</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Client List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Sales chart -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4 class="card-title mb-0">
                                    @if(request('q'))
                                        Search results for: <strong>"{{ request('q') }}"</strong>
                                        <span class="badge badge-info ml-2">{{ count($users) }} found</span>
                                    @else
                                        All Clients
                                    @endif
                                </h4>
                                @if(request('q'))
                                    <a href="{{ route('admin.clients') }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="ti-close mr-1"></i> Clear Search
                                    </a>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>P-ID</th>
                                            <th>Phone</th>
                                            <th>Balance</th>
                                            <th>Available</th>
                                            <th>Total Orders</th>
                                            <th>Reward</th>
                                            <th>%</th>
                                            <th>PID Name</th>
                                            <th>Referral Code</th>
                                            <th>Membership</th>
                                            <th>Status</th>
                                            <th>Registration Time</th>
                                            <th>Last Login</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user['user']->id }}</td>
                                                <td>{{ $user['user']->name }}</td>
                                                <td>{{ $user['user']->parent_id }}</td>
                                                <td>{{ $user['user']->phone }}</td>
                                                <td>{{ $user['balance'] }}</td>
                                                <td>{{ $user['available'] }}</td>
                                                <td>{{ $user['processed_orders_count'] }}</td>
                                                <td>{{ $user['daily_commission'] }}</td>
                                                <td>{{ $user['commission_percent'] }}%</td>
                                                <td>{{ $user['parent_name'] }}</td>
                                                <td>{{ $user['user']->reference_code }}</td>
                                                <td>{{ $user['membership_level']->level_name }}</td>
                                                <td>{{ $user['user']->status }}</td>
                                                <td>{{ $user['user']->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td>{{ $user['last_login']->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    @if (Auth::user()->user_type == 1 || Auth::user()->id != $user['user']->parent_id)
                                                        {{-- Admin: full action set --}}
                                                        <a href="{{ route('admin.setup-orders', $user['user']->id) }}"
                                                            class="btn btn-primary btn-sm">Setup Orders</a>
                                                        <a href="{{ route('admin.funds.add', $user['user']->id) }}"
                                                            class="btn btn-warning btn-sm">Add Debit</a>
                                                        <form
                                                            action="{{ route('admin.reset-todays-orders', $user['user']->id) }}"
                                                            method="POST" style="display:inline"
                                                            onsubmit="return confirm('Reset today\'s orders for this user?');">
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm" type="submit">Reset
                                                                Orders</button>
                                                        </form>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-secondary btn-sm dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                More Action
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.edit-client', $user['user']->id) }}">Edit
                                                                    Client</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.wallet', $user['user']->id) }}">Wallet
                                                                    Information</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.funds.recharge', $user['user']->id) }}">Recharge
                                                                    History</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.funds.redemption', $user['user']->id) }}">Redemption
                                                                    History</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.clients.orders', $user['user']->id) }}">Journeys</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>P-ID</th>
                                            <th>Phone</th>
                                            <th>Balance</th>
                                            <th>Available</th>
                                            <th>Total Orders</th>
                                            <th>Reward</th>
                                            <th>%</th>
                                            <th>PID Name</th>
                                            <th>Referral Code</th>
                                            <th>Membership</th>
                                            <th>Status</th>
                                            <th>Registration Time</th>
                                            <th>Last Login</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    @endsection
