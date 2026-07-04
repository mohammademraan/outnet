@extends('admin.layouts.master')

@section('title', 'Add Wallet Information')

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Add Wallet Information</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Wallet for {{ $user->name ?? '' }}</h4>
                        </div>
                        <hr class="m-t-0">

                        <form method="POST" action="{{ route('admin.wallet.store') }}">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Wallet Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="vallet_address" class="form-control" placeholder="Wallet address" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Wallet Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" class="form-control">
                                            <option value="TRC20">TRC20</option>
                                            <option value="ERC20">ERC20</option>
                                            <option value="ETH">ETH</option>
                                            <option value="BTC">BTC</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    <button type="submit" class="btn btn-info">Save</button>
                                    <a href="{{ route('admin.clients') }}" class="btn btn-dark">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
