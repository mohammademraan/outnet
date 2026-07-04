@extends('admin.layouts.master')

@section('title', 'Wallet Information')

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Wallet Information for {{ $user->name ?? 'User' }}</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Wallet Details</h4>
                            @if (isset($valletInformation) && $valletInformation)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Account Title</th>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Wallet Address</th>
                                                <td>{{ $valletInformation->vallet_address }}</td>
                                            </tr>
                                            <tr>
                                                <th>Wallet Type</th>
                                                <td>{{ $valletInformation->type }}</td>
                                            </tr>
                                            <tr>
                                                <th>Contact Number</th>
                                                <td>{{ $valletInformation->phone }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ url('administration') }}" class="btn btn-dark">Back to Users</a>
                                    <a href="{{ route('admin.wallet.edit', $user->id) }}" class="btn btn-primary">Edit
                                        Wallet</a>
                                </div>
                            @else
                                <p>No wallet information available for this user.</p>
                                <a href="{{ route('admin.wallet.create', $user->id) }}" class="btn btn-primary">Add Wallet
                                    Information</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
