@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Pending Withdrawal Requests</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pending Withdrawal Requests</h4>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($funds as $fund)
                                            <tr>
                                                <td>{{ $fund->id }}</td>
                                                <td>
                                                    @if($fund->user)
                                                        {{ $fund->user->name }}<br>
                                                        <small>{{ $fund->user->email ?? $fund->user->phone }}</small>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $fund->amount }}</td>
                                                <td>{{ $fund->type }}</td>
                                                <td>{{ $fund->status }}</td>
                                                <td>
                                                    @if($fund->status === 'pending')
                                                        <div class="d-flex gap-2">
                                                            <form action="{{ route('admin.funds.approve', $fund->id) }}" method="POST" style="margin: 0;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                            </form>
                                                            <form action="{{ route('admin.funds.reject', $fund->id) }}" method="POST" style="margin: 0;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $fund->created_at->format('Y-m-d H:i:s') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No pending withdrawals found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
