@php
    use App\Models\Funds;
    use App\Models\User;
    use App\Models\Orders;
    $pendingRechargeCount    = Funds::where('type', 'deposit')->where('status', 'pending')->count();
    $pendingWithdrawalCount  = Funds::where('type', 'withdrawal')->where('status', 'pending')->count();
    $pendingTotal            = $pendingRechargeCount + $pendingWithdrawalCount;
    $recentUsers             = User::where('user_type', 0)->orderBy('created_at', 'desc')->take(5)->get();
    $recentActivity          = Orders::with(['user', 'orderList'])->where('type', 'Complete')
                                     ->where('status', 'active')->orderBy('created_at', 'desc')->take(5)->get();
@endphp
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/assets/images/favicon.png') }}">
    <title>@yield('title', 'Dashboard') – Outnet Admin</title>
    <!-- Custom CSS -->
    <link href="{{ asset('admin/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('admin/dist/css/style.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <a href="{{ route('admin.dashboard') }}" class="logo" style="color: #000; font-weight: bold;">OUTNET</a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-magnify font-20 mr-1"></i>
                                    <div class="ml-1 d-none d-sm-block">
                                        <span>Search</span>
                                    </div>
                                </div>
                            </a>
                            <form class="app-search position-absolute"
                                  action="{{ route('admin.clients') }}"
                                  method="GET">
                                <input type="text"
                                       name="q"
                                       class="form-control"
                                       placeholder="Search by name, email, phone, code…"
                                       value="{{ request('q') }}"
                                       autocomplete="off">
                                <a class="srh-btn" href="{{ route('admin.clients') }}">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Pending Requests (bell) -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown border-right">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-bell-outline font-22"></i>
                                @if($pendingTotal > 0)
                                    <span class="badge badge-pill badge-info noti">{{ $pendingTotal }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title bg-primary text-white">
                                            <h4 class="m-b-0 m-t-5">{{ $pendingTotal }}</h4>
                                            <span class="font-light">Pending Requests</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications">
                                            <a href="{{ route('admin.funds.recharge.requests') }}" class="message-item">
                                                <span class="btn btn-warning btn-circle">
                                                    <i class="mdi mdi-bank-transfer-in"></i>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Recharge Requests</h5>
                                                    <span class="mail-desc">{{ $pendingRechargeCount }} pending approval</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('admin.funds.redemption.requests') }}" class="message-item">
                                                <span class="btn btn-danger btn-circle">
                                                    <i class="mdi mdi-bank-transfer-out"></i>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Withdrawal Requests</h5>
                                                    <span class="mail-desc">{{ $pendingWithdrawalCount }} pending approval</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('admin.clients') }}" class="message-item">
                                                <span class="btn btn-success btn-circle">
                                                    <i class="ti-user"></i>
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Total Clients</h5>
                                                    <span class="mail-desc">{{ \App\Models\User::where('user_type', 0)->count() }} registered users</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center m-b-5 text-dark"
                                           href="{{ route('admin.dashboard') }}">
                                            <strong>Go to dashboard</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Pending Requests (bell) -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- Avatar initial circle --}}
                                <span class="rounded-circle d-inline-flex align-items-center justify-content-center
                                             font-weight-bold text-white"
                                      style="width:40px;height:40px;background:linear-gradient(135deg,#6c47ff,#00bcd4);
                                             font-size:16px;vertical-align:middle;">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                </span>
                                <span class="m-l-5 font-medium d-none d-sm-inline-block">
                                    {{ auth()->user()->name ?? 'Admin' }}
                                    <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle
                                                font-weight-bold text-white"
                                         style="width:60px;height:60px;background:rgba(255,255,255,0.25);
                                                font-size:24px;flex-shrink:0;">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">{{ auth()->user()->name ?? 'Admin' }}</h4>
                                        <p class="m-b-0 font-12">{{ auth()->user()->email ?? '' }}</p>
                                        <span class="badge badge-light font-10 m-t-5">
                                            @if (auth()->user()->user_type == 1)
                                                🛡️ Administrator
                                            @elseif (auth()->user()->user_type == 2)
                                                👁️ Moderator
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{ route('admin.clients') }}">
                                    <i class="ti-user m-r-5 m-l-5"></i> Manage Clients
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="ti-dashboard m-r-5 m-l-5"></i> Dashboard
                                </a>
                                <div class="dropdown-divider"></div>
                                {{-- Logout via POST form (required by Laravel CSRF protection) --}}
                                <form method="POST" action="{{ route('admin.logout') }}" id="adminLogoutForm">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-danger" href="#"
                                   onclick="event.preventDefault(); document.getElementById('adminLogoutForm').submit();">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout
                                </a>
                                <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10">
                                    <a href="{{ route('admin.clients') }}"
                                       class="btn btn-sm btn-success btn-rounded">
                                        View Clients
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- Dashboard -->
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span
                                class="hide-menu">Dashboard</span></li>
                        <li class="sidebar-item"> <a href="{{ route('admin.dashboard') }}"
                                class="sidebar-link waves-effect waves-dark"><i class="mdi mdi-av-timer"></i><span
                                    class="hide-menu">Dashboard </span></a></li>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span
                                class="hide-menu">Clients</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span
                                    class="hide-menu">Clients</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="{{ asset('admin/add-client') }}" class="sidebar-link"><i
                                            class="mdi mdi-priority-low"></i><span class="hide-menu"> Add New
                                            Client</span></a></li>
                                <li class="sidebar-item"><a href="{{ asset('admin/clients') }}" class="sidebar-link"><i
                                            class="mdi mdi-rounded-corner"></i><span class="hide-menu"> View All
                                            Clients</span></a></li>
                            </ul>
                        </li>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">
                                Order List</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i
                                    class="mdi mdi-border-none"></i><span class="hide-menu"> Order List</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"> <a href="{{ route('admin.orderlists.create') }}"
                                        class="sidebar-link waves-effect waves-dark sidebar-link"
                                        aria-expanded="false"><i class="mdi mdi-border-top"></i><span
                                            class="hide-menu"> Add Order Item</span></a></li>
                                <li class="sidebar-item"> <a href="{{ route('admin.orderlists.index') }}"
                                        class="sidebar-link waves-effect waves-dark sidebar-link"
                                        aria-expanded="false"><i class="mdi mdi-border-style"></i><span
                                            class="hide-menu"> View Order List</span></a></li>
                            </ul>
                        </li>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span
                                class="hide-menu">Memberships</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i
                                    class="mdi mdi-notification-clear-all"></i><span
                                    class="hide-menu">Membership</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="{{ route('admin.memberships.create') }}"
                                        class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">
                                            Add Membership</span></a></li>
                                <li class="sidebar-item"><a href="{{ route('admin.memberships.index') }}"
                                        class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu">
                                            View Memberships</span></a></li>
                            </ul>
                        </li>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span
                                class="hide-menu">Journeys</span></li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.orders') }}" class="sidebar-link waves-effect waves-dark"
                                aria-expanded="false">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span class="hide-menu">Journeys</span>
                            </a>
                        </li>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span
                                class="hide-menu">Requests</span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false">
                                <i class="mdi mdi-cash-multiple"></i>
                                <span class="hide-menu">Funds Requests</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="{{ route('admin.funds.recharge.requests') }}"
                                        class="sidebar-link"><i class="mdi mdi-bank-transfer-in"></i><span
                                            class="hide-menu"> Recharge Requests</span></a></li>
                                <li class="sidebar-item"><a href="{{ route('admin.funds.redemption.requests') }}"
                                        class="sidebar-link"><i class="mdi mdi-bank-transfer-out"></i><span
                                            class="hide-menu"> Redemption Requests</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        @yield('content')

        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            &copy; {{ date('Y') }} Outnet. All rights reserved.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle">
            <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                        role="tab" aria-controls="pills-home" aria-selected="true">
                        <i class="mdi mdi-wrench font-20"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab"
                        aria-controls="chat" aria-selected="false">
                        <i class="mdi mdi-message-reply font-20"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                        role="tab" aria-controls="pills-contact" aria-selected="false">
                        <i class="mdi mdi-star-circle font-20"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="p-15 border-bottom">
                        <!-- Sidebar -->
                        <h5 class="font-medium m-b-10 m-t-10">Layout Settings</h5>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="theme-view" id="theme-view">
                            <label class="custom-control-label" for="theme-view">Dark Theme</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="sidebar-position"
                                id="sidebar-position">
                            <label class="custom-control-label" for="sidebar-position">Fixed Sidebar</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="header-position"
                                id="header-position">
                            <label class="custom-control-label" for="header-position">Fixed Header</label>
                        </div>
                        <div class="custom-control custom-checkbox m-t-10">
                            <input type="checkbox" class="custom-control-input" name="boxed-layout"
                                id="boxed-layout">
                            <label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Logo Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-logobg="skin1"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-logobg="skin2"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-logobg="skin3"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-logobg="skin4"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-logobg="skin5"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-logobg="skin6"></a>
                            </li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Navbar BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Navbar Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin1"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin2"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin3"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin4"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin5"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin6"></a>
                            </li>
                        </ul>
                        <!-- Navbar BG -->
                    </div>
                    <div class="p-15 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium m-b-10 m-t-10">Sidebar Backgrounds</h5>
                        <ul class="theme-color">
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a>
                            </li>
                            <li class="theme-item">
                                <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a>
                            </li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                </div>
                <!-- End Tab 1 -->
                <!-- Tab 2 — Recent Members -->
                <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <h6 class="m-t-20 m-b-10 p-l-15">Recently Joined Members</h6>
                    <ul class="mailbox list-style-none m-t-10">
                        <li>
                            <div class="message-center chat-scroll">
                                @forelse($recentUsers as $ru)
                                <a href="{{ route('admin.clients') }}" class="message-item">
                                    <span class="user-img">
                                        <span class="rounded-circle d-inline-flex align-items-center justify-content-center font-weight-bold text-white"
                                              style="width:40px;height:40px;background:linear-gradient(135deg,#6c47ff,#00bcd4);font-size:16px;flex-shrink:0;">
                                            {{ strtoupper(substr($ru->name ?? 'U', 0, 1)) }}
                                        </span>
                                        <span class="profile-status {{ $ru->status === 'active' ? 'online' : 'offline' }} pull-right"></span>
                                    </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title">{{ $ru->name }}</h5>
                                        <span class="mail-desc">{{ $ru->email }}</span>
                                        <span class="time">{{ optional($ru->created_at)->diffForHumans() }}</span>
                                    </div>
                                </a>
                                @empty
                                <div class="p-15 text-center text-muted font-12">No members yet.</div>
                                @endforelse
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End Tab 2 -->
                <!-- Tab 3 — Recent Activity -->
                <div class="tab-pane fade p-15" id="pills-contact" role="tabpanel"
                    aria-labelledby="pills-contact-tab">
                    <h6 class="m-t-20 m-b-20">Recent Completed Tasks</h6>
                    <div class="steamline">
                        @forelse($recentActivity as $act)
                        <div class="sl-item">
                            <div class="sl-left bg-success">
                                <i class="ti-check"></i>
                            </div>
                            <div class="sl-right">
                                <div class="font-medium">
                                    {{ optional($act->orderList)->title ?? 'Task #'.$act->id }}
                                    <span class="sl-date">{{ optional($act->created_at)->diffForHumans() }}</span>
                                </div>
                                <div class="desc">
                                    By {{ optional($act->user)->name ?? 'Unknown' }} —
                                    ${{ number_format($act->total_amount ?? 0, 2) }}
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-muted font-12 p-10">No completed tasks yet.</div>
                        @endforelse
                    </div>
                </div>
                <!-- End Tab 3 -->
            </div>
        </div>
    </aside>
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <script src="{{ asset('admin/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/app.init.horizontal.js') }}"></script>
    <script src="{{ asset('admin/dist/js/app-style-switcher.horizontal.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('admin/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('admin/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('admin/dist/js/custom.js') }}"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="{{ asset('admin/assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <!--c3 charts -->
    <script src="{{ asset('admin/assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('admin/assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('admin/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/dist/js/pages/dashboards/dashboard1.js') }}"></script>
    <!--This page plugins -->
    <script src="{{ asset('admin/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
</body>

</html>
