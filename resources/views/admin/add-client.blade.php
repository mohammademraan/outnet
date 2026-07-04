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
                    <h4 class="page-title">Add Client</h4>
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
                                <li class="breadcrumb-item active" aria-current="page">Add Client</li>
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
                            <h4 class="card-title">Add Clients Data</h4>
                        </div>
                        <hr class="m-t-0">
                        <form class="form-horizontal striped-rows b-form" method="POST"
                            action="{{ route('admin.add-client.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="username" class="form-control"
                                            value="{{ old('username') }}" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Parent ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="parentUser" list="parentList" class="form-control" placeholder="Select or Search Parent User" required>
                                        <datalist id="parentList">
                                            @foreach ($users as $parent)
                                                <option value="{{ $parent->id }}">#{{ $parent->id }} - {{ $parent->name }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Phone Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone') }}" placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password')">
                                                    <i class="fas fa-eye" id="password-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Wallet Password</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="password" name="vallet_password" id="vallet_password"
                                                class="form-control" placeholder="Wallet Password" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('vallet_password')">
                                                    <i class="fas fa-eye" id="vallet_password-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Credibility</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="credibility" class="form-control"
                                            value="{{ old('credibility', 100) }}" placeholder="Credibility" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Opening Balance</label>
                                    <div class="col-sm-9">
                                        <input type="number" step="0.01" name="op_balance" class="form-control"
                                            value="{{ old('op_balance', 0) }}" placeholder="Opening Balance" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Minimum Withdraw</label>
                                    <div class="col-sm-9">
                                        <input type="number" step="0.01" name="min_withdraw" class="form-control"
                                            value="{{ old('min_withdraw', 50) }}" placeholder="Minimum Withdraw" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Maximum Withdraw</label>
                                    <div class="col-sm-9">
                                        <input type="number" step="0.01" name="max_withdraw" class="form-control"
                                            value="{{ old('max_withdraw', 3000) }}" placeholder="Maximum Withdraw"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">User Type</label>
                                    <div class="col-sm-9">
                                        <select name="userType" class="form-control" required>
                                            <option value="0" {{ old('userType') === '0' ? 'selected' : '' }}>User
                                            </option>
                                            <option value="1" {{ old('userType') === '1' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="2" {{ old('userType') === '2' ? 'selected' : '' }}>
                                                Moderator</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label col-form-label">Membership Level</label>
                                    <div class="col-sm-9">
                                        <select name="memLevel" class="form-control" required>
                                            <option value="">Select Membership Level</option>
                                            @foreach ($memberships as $membership)
                                                <option value="{{ $membership->id }}"
                                                    {{ old('memLevel') == $membership->id ? 'selected' : '' }}>
                                                    {{ $membership->level_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                    <a href="{{ route('admin.clients') }}"
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
        <script>
            function togglePassword(id) {
                var input = document.getElementById(id);
                var icon = document.getElementById(id + '-icon');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'fas fa-eye-slash';
                } else {
                    input.type = 'password';
                    icon.className = 'fas fa-eye';
                }
            }
        </script>
    @endsection
