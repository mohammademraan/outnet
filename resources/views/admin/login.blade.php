<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/assets/images/favicon.png') }}">
    <title>Admin Login – Outnet</title>
    <link href="{{ asset('admin/dist/css/style.min.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
             style="background:url({{ asset('admin/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db" style="font-weight:700;font-size:28px;letter-spacing:1.5px;color:#333;display:block;margin-bottom:15px;text-align:center;">
                            OUTNET
                        </span>
                        <h5 class="font-medium m-b-5 m-t-10">Sign In to Admin Panel</h5>
                        <p class="text-muted font-12">
                            Admin &amp; Moderator access only
                        </p>
                    </div>

                    {{-- Error / session messages --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="ti-alert m-r-5"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <div><i class="ti-alert m-r-5"></i> {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            {{-- form POSTs to admin.login.post; uses `name` field (not email) --}}
                            <form class="form-horizontal m-t-20"
                                  action="{{ route('admin.login.post') }}"
                                  method="POST">
                                @csrf

                                {{-- Username --}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="ti-user"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                           name="name"
                                           class="form-control form-control-lg @error('name') is-invalid @enderror"
                                           placeholder="Username"
                                           value="{{ old('name') }}"
                                           autocomplete="username"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="ti-pencil"></i>
                                        </span>
                                    </div>
                                    <input type="password"
                                           name="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           placeholder="Password"
                                           autocomplete="current-password"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Remember me --}}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="rememberMe"
                                                   name="remember">
                                            <label class="custom-control-label" for="rememberMe">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">
                                            Log In
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                {{-- / #loginform --}}

            </div>
            {{-- / .auth-box --}}
        </div>

    </div>

    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
</body>
</html>
