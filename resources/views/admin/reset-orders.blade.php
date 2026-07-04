@extends('admin.layouts.master')

@section('title', 'Set Single Continuous')

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Select Orders</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.save-selected-orders', $user->id) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>After Order Number:</label>
                                    <input type="text" name="order_after" class="form-control" placeholder="Enter order number after which these orders will be received" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Selected Orders</button>
                                </div>

                                <div class="form-group">
                                    <label>Select Orders:</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order_list as $item)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="selected_orders[]" value="{{ $item->id }}">
                                                        </td>
                                                        <td>{{ $item->title }}</td>
                                                        <td>{{ $item->price }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </form>

                            @if (session('selected_orders'))
                                <div class="table-responsive mt-4">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Title</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (session('selected_orders') as $order)
                                                <tr>
                                                    <td>{{ $order['id'] }}</td>
                                                    <td>{{ $order['title'] }}</td>
                                                    <td>{{ $order['price'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
