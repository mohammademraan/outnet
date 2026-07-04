@extends('admin.layouts.master')

@section('title', 'All Orders')

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">All Active Orders</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Active Orders</h4>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Order Item</th>
                                            <th>Order Price</th>
                                            <th>Total Amount</th>
                                            <th>Commission</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>
                                                    @if($order->user)
                                                        {{ $order->user->name }}<br>
                                                        <small>{{ $order->user->email ?? $order->user->phone }}</small>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($order->orderList)
                                                        {{ $order->orderList->title ?? $order->orderList->name ?? 'Order Item' }}
                                                    @else
                                                        {{ $order->order_id }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($order->orderList && isset($order->orderList->price))
                                                        {{ number_format($order->orderList->price, 2) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ isset($order->total_amount) ? number_format($order->total_amount, 2) : '-' }}</td>
                                                <td>
                                                    @php
                                                        $orderPrice = $order->orderList->price ?? 0;
                                                        $commission = isset($order->total_amount) ? ($order->total_amount - $orderPrice) : null;
                                                    @endphp
                                                    @if(!is_null($commission))
                                                        {{ number_format($commission, 2) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $order->type }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i:s') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->updated_at)->format('Y-m-d H:i:s') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No active orders found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Order Item</th>
                                            <th>Order Price</th>
                                            <th>Total Amount</th>
                                            <th>Commission</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
