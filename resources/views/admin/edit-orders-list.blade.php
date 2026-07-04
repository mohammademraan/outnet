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
                    <h4 class="page-title">Edit Order Item</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.orderlists.index') }}">Order List</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Order Item</li>
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
            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Order Item</h4>
                        </div>
                        <hr class="m-t-0">
                        <form class="form-horizontal striped-rows b-form" method="POST" action="{{ route('admin.orderlists.update', $orderList->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="form-control" value="{{ old('title', $orderList->title) }}" placeholder="Order title" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $orderList->price) }}" placeholder="Price" required>
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="form-control" rows="4" placeholder="Description">{{ old('description', $orderList->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        @if ($orderList->image)
                                            <div class="mb-2">
                                                <img src="{{ asset('OrderImages/' . $orderList->image) }}" alt="{{ $orderList->title }}" width="120" height="80">
                                            </div>
                                        @endif
                                        <input type="file" name="image" class="form-control-file" accept="image/*">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                    <a href="{{ route('admin.orderlists.index') }}" class="btn btn-dark waves-effect waves-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    @endsection
