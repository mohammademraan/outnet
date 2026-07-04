@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Edit Wallet Information</h4>
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
                                <li class="breadcrumb-item active" aria-current="page">Edit Wallet Information</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Wallet Information for @if (isset($user))
                                    {{ $user->name }} (#{{ $user->id }})
                                @endif
                            </h4>
                        </div>
                        <hr class="m-t-0">

                        <form method="POST" action="{{ route('admin.wallet.update') }}">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Wallet Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="vallet_address" class="form-control" value="{{ $valletInformation->vallet_address ?? '' }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Wallet Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" class="form-control">
                                            <option value="TRC20" {{ (isset($valletInformation) && $valletInformation->type=='TRC20')? 'selected' : '' }}>TRC20</option>
                                            <option value="ERC20" {{ (isset($valletInformation) && $valletInformation->type=='ERC20')? 'selected' : '' }}>ERC20</option>
                                            <option value="ETH" {{ (isset($valletInformation) && $valletInformation->type=='ETH')? 'selected' : '' }}>ETH</option>
                                            <option value="BTC" {{ (isset($valletInformation) && $valletInformation->type=='BTC')? 'selected' : '' }}>BTC</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control" value="{{ $valletInformation->phone ?? '' }}" required>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    <button type="submit" class="btn btn-info">Update Wallet</button>
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
