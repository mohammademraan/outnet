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
                    <h4 class="page-title">Add Membership Level</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.memberships.index') }}">Membership Levels</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add Membership</li>
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
                            <h4 class="card-title">Add New Membership Level</h4>
                        </div>
                        <hr class="m-t-0">
                        <form class="form-horizontal striped-rows b-form" method="POST"
                            action="{{ route('admin.memberships.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Level Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="membership" class="form-control"
                                            value="{{ old('membership') }}" placeholder="e.g., Silver, Gold, Platinum" required>
                                        @error('membership')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Order Limit</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="order_limit" class="form-control"
                                            value="{{ old('order_limit') }}" placeholder="Maximum number of orders" required>
                                        @error('order_limit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Commission (%)</label>
                                    <div class="col-sm-9">
                                        <input type="number" step="0.01" name="commission" class="form-control"
                                            value="{{ old('commission') }}" placeholder="Commission percentage" required>
                                        @error('commission')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                    <a href="{{ route('admin.memberships.index') }}"
                                        class="btn btn-dark waves-effect waves-light">Cancel</a>
                                </div>
                            </div>
                        </form>
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
