@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Add Funds</h4>
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
                                <li class="breadcrumb-item active" aria-current="page">Add Funds</li>
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
                            <h4 class="card-title">Add Funds for @if (isset($user))
                                    {{ $user->name }} (#{{ $user->id }})
                                @endif
                            </h4>
                        </div>
                        <hr class="m-t-0">

                        <form class="form-horizontal" method="POST" action="{{ route('admin.funds.store') }}">
                            @csrf
                            <div class="card-body">
                                @if (isset($user))
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                @else
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">User</label>
                                        <div class="col-sm-9">
                                            <select name="id" class="form-control" required>
                                                @foreach (App\Models\User::all() as $u)
                                                    <option value="{{ $u->id }}">#{{ $u->id }} -
                                                        {{ $u->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" class="form-control" required>
                                            <option value="deposit">Deposit</option>
                                            <option value="withdrawal">Withdrawal</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Amount</label>
                                    <div class="col-sm-9">
                                        <input type="number" step="0.01" name="amount" class="form-control"
                                            placeholder="Amount" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Note (optional)</label>
                                    <div class="col-sm-9">
                                        <textarea name="note" class="form-control" rows="3" placeholder="Optional note or description"></textarea>
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
