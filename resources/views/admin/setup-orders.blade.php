@extends('admin.layouts.master')

@section('title', 'Setup Orders')

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Setup Orders for {{ $user->name }}</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($selected_order_list->isEmpty())
                                <p>No orders selected for this user.</p>
                                <a href="{{ route('admin.reset-single-order', $user->id) }}" class="btn btn-primary">Setup Order</a>
                            @else
                                @if (session('order_success'))
                                    <div class="alert alert-success">{{ session('order_success') }}</div>
                                @endif
                                @if (session('order_error'))
                                    <div class="alert alert-danger">{{ session('order_error') }}</div>
                                @endif

                                <form action="{{ route('admin.update-orders', $user->id) }}" method="POST">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Order After</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($selected_order_list as $order)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="selected_orders[]" value="{{ $order->id }}" checked>
                                                        </td>
                                                        <td>{{ $order->orderList->title }}</td>
                                                        <td>{{ $order->orderList->price }}</td>
                                                        <td>{{ $order->order_after }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Update Orders</button>
                                        <a href="{{ route('admin.reset-single-order', $user->id) }}" class="btn btn-primary">Setup Order</a>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
