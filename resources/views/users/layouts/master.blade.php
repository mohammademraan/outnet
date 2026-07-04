<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>THE OUTNET | Premium Fashion &amp; Style</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('user/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('user/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('user/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('user/assets/img/favicons/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Preloader -->
    <link href="{{ asset('user/vendors/loaders.css/loaders.min.css') }}" rel="stylesheet">

    <!-- Base theme (Bootstrap grid + utilities) -->
    <link href="{{ asset('user/assets/css/theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/assets/css/user.min.css') }}" rel="stylesheet">

    <!-- THE OUTNET skin -->
    <link href="{{ asset('user/assets/css/panel-theme.css') }}" rel="stylesheet">
</head>

<body class="overflow-hidden-x">

    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="loader">
            <div class="line-scale-pulse-out-rapid">
                <div></div><div></div><div></div><div></div><div></div>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════ HEADER ═══════════════════════════════════ -->
    <header class="on-header" id="on-header">

        {{-- Promo bar — always visible --}}
        <div class="on-promo-bar">
            @auth
                Complete today&rsquo;s evaluations &amp; earn your daily commission
            @else
                Sign up today &mdash; premium designer offers, up to 70% off
            @endauth
        </div>

        {{-- Main header row: hamburger/search | logo | account icons --}}
        <div class="on-header-main">
            <div class="on-header-inner">

                {{-- Left: hamburger (mobile) + search (desktop) --}}
                <div class="on-header-left">
                    <button class="on-hamburger d-lg-none" id="on-menu-toggle" aria-label="Open menu" aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <a class="on-icon-btn d-none d-lg-inline-flex" href="{{ auth()->check() ? route('user.tasks') : route('users.about') }}" aria-label="Search">
                        <i class="fas fa-search"></i>
                    </a>
                </div>

                {{-- Centre: wordmark --}}
                <div class="on-header-center">
                    <a class="on-logo" href="{{ route('users.home') }}">THE OUTNET</a>
                </div>

                {{-- Right: account / icons --}}
                <div class="on-header-right">
                    @auth
                    <a class="on-icon-btn d-none d-sm-inline-flex" href="{{ route('user.wallet') }}" aria-label="Wallet">
                        <i class="far fa-heart"></i>
                    </a>
                    <a class="on-icon-btn d-none d-sm-inline-flex" href="{{ route('generate.order') }}" aria-label="Evaluate">
                        <i class="fas fa-shopping-bag"></i>
                    </a>
                    <div class="on-account" id="on-account">
                        <button class="on-avatar" id="on-avatar-btn" aria-label="Account menu" aria-expanded="false">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </button>
                        <div class="on-account-dropdown" id="on-account-dropdown" aria-hidden="true">
                            <div class="on-account-info">
                                <strong>{{ auth()->user()->name }}</strong>
                                <span>{{ auth()->user()->email }}</span>
                            </div>
                            <a href="{{ route('user.profile') }}">Profile</a>
                            <a href="{{ route('user.wallet') }}">Wallet</a>
                            <a href="{{ route('user.recharge') }}">Deposit</a>
                            <a href="{{ route('user.redemption') }}">Withdraw</a>
                            <a href="{{ route('user.recharge-history') }}">Deposit History</a>
                            <a href="{{ route('user.redemption-history') }}">Withdrawal History</a>
                            <div class="on-account-divider"></div>
                            <a href="{{ route('logout') }}"
                               class="on-signout"
                               onclick="event.preventDefault(); document.getElementById('on-logout-form').submit();">
                                Sign Out
                            </a>
                            <form id="on-logout-form" action="{{ route('logout') }}" method="POST" hidden>@csrf</form>
                        </div>
                    </div>
                    @else
                    <div class="on-guest-links">
                        <a class="on-icon-btn d-none d-sm-inline-flex" href="{{ route('user.login') }}" aria-label="Sign in">
                            <i class="far fa-user"></i>
                        </a>
                        <a href="{{ route('user.login') }}" class="on-signin-link">Sign In</a>
                        <a href="{{ route('register') }}" class="on-register-link">Register</a>
                    </div>
                    @endauth
                </div>

            </div>
        </div>

        {{-- Primary nav — centered under logo, desktop --}}
        <nav class="on-nav-bar d-none d-lg-block">
            <ul class="on-nav-list">
                @auth
                <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('generate.order') }}">Evaluate</a></li>
                <li><a href="{{ route('user.tasks') }}">History</a></li>
                <li><a href="{{ route('user.wallet') }}">Wallet</a></li>
                <li><a href="{{ route('user.recharge') }}">Deposit</a></li>
                <li><a href="{{ route('user.redemption') }}">Withdraw</a></li>
                <li><a href="{{ route('user.profile') }}">Profile</a></li>
                <li><a href="{{ route('user.support') }}">Support</a></li>
                @else
                <li><a href="{{ route('users.home') }}">Home</a></li>
                <li><a href="{{ route('register') }}">Just In</a></li>
                <li><a href="{{ route('register') }}">Designers</a></li>
                <li><a href="{{ route('register') }}">Clothing</a></li>
                <li><a href="{{ route('register') }}">Shoes</a></li>
                <li><a href="{{ route('register') }}">Bags</a></li>
                <li><a href="{{ route('register') }}">Accessories</a></li>
                <li><a class="on-nav-sale" href="{{ route('register') }}">Sale</a></li>
                @endauth
            </ul>
        </nav>

        {{-- Mobile drawer --}}
        <div class="on-drawer" id="on-drawer" aria-hidden="true">
            <div class="on-drawer-inner">
                <button class="on-drawer-close" id="on-drawer-close" aria-label="Close menu">&#x2715;</button>
                <ul class="on-drawer-nav">
                    @auth
                    <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('generate.order') }}">Evaluate</a></li>
                    <li><a href="{{ route('user.tasks') }}">History</a></li>
                    <li><a href="{{ route('user.wallet') }}">Wallet</a></li>
                    <li><a href="{{ route('user.recharge') }}">Deposit</a></li>
                    <li><a href="{{ route('user.redemption') }}">Withdraw</a></li>
                    <li><a href="{{ route('user.recharge-history') }}">Deposit History</a></li>
                    <li><a href="{{ route('user.redemption-history') }}">Withdrawal History</a></li>
                    <li><a href="{{ route('user.profile') }}">Profile</a></li>
                    <li><a href="{{ route('user.change-password') }}">Change Password</a></li>
                    <li><a href="{{ route('user.support') }}">Support</a></li>
                    <li class="on-drawer-sep"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('on-logout-form').submit();">
                            Sign Out
                        </a>
                    </li>
                    @else
                    <li><a href="{{ route('users.home') }}">Home</a></li>
                    <li><a href="{{ route('user.login') }}">Sign In</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li class="on-drawer-sep"></li>
                    <li><a href="{{ route('users.about') }}">About Us</a></li>
                    <li><a href="{{ route('users.privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('users.contact') }}">Contact</a></li>
                    @endauth
                </ul>
            </div>
        </div>

    </header>

    <!-- Overlay (closes drawer and dropdown on click) -->
    <div class="on-overlay" id="on-overlay"></div>

    <!-- ═══════════════════════════════════ MAIN ════════════════════════════════════ -->
    <main class="main" id="top">
        @yield('content')
    </main>

    <!-- ══════════════════════════════════ FOOTER ════════════════════════════════════ -->
    <footer class="on-footer">

        {{-- Newsletter band --}}
        <div class="on-footer-newsletter">
            <div class="container">
                <p class="on-footer-news-title">Never miss a thing</p>
                <p class="on-footer-news-sub">Sign up for promotions, new arrivals and exclusive member offers</p>
                <form class="on-footer-news-form" onsubmit="event.preventDefault(); this.querySelector('button').innerHTML='&#10003; Subscribed'; this.querySelector('input').disabled=true;">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit">Sign Up</button>
                </form>
            </div>
        </div>

        {{-- Link columns --}}
        <div class="on-footer-links">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-6 col-md-3">
                        <p class="on-footer-col-title">Customer Care</p>
                        <ul class="on-footer-col-list">
                            <li><a href="{{ route('users.contact') }}">Contact Us</a></li>
                            @auth
                            <li><a href="{{ route('user.support') }}">Support</a></li>
                            <li><a href="{{ route('user.faqs') }}">FAQs</a></li>
                            @else
                            <li><a href="{{ route('user.login') }}">Support</a></li>
                            <li><a href="{{ route('user.login') }}">FAQs</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <p class="on-footer-col-title">About Us</p>
                        <ul class="on-footer-col-list">
                            <li><a href="{{ route('users.about') }}">Our Story</a></li>
                            @auth
                            <li><a href="{{ route('user.company') }}">Company</a></li>
                            <li><a href="{{ route('user.terms') }}">Terms &amp; Conditions</a></li>
                            @else
                            <li><a href="{{ route('users.about') }}">Careers</a></li>
                            <li><a href="{{ route('users.privacy') }}">Terms &amp; Conditions</a></li>
                            @endauth
                            <li><a href="{{ route('users.privacy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <p class="on-footer-col-title">My Account</p>
                        <ul class="on-footer-col-list">
                            @auth
                            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('user.wallet') }}">Wallet</a></li>
                            <li><a href="{{ route('user.tasks') }}">Order History</a></li>
                            @else
                            <li><a href="{{ route('user.login') }}">Sign In</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <p class="on-footer-col-title">Follow Us</p>
                        <div class="on-footer-social">
                            <a href="#!" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#!" aria-label="X"><i class="fab fa-twitter"></i></a>
                            <a href="#!" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#!" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        </div>
                        <p class="on-footer-col-title mt-4">We Accept</p>
                        <div class="on-footer-payments">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-amex"></i>
                            <i class="fab fa-cc-paypal"></i>
                            <i class="fab fa-cc-apple-pay"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="on-footer-bottom">
            <div class="container">
                <div class="on-footer-inner">
                    <p class="on-footer-copy">&copy; {{ date('Y') }} THE OUTNET&trade;. All rights reserved.</p>
                    <a class="on-back-top" href="#top">&#x2191; Back to top</a>
                </div>
            </div>
        </div>

    </footer>

    <!-- ══════════════════════════════════ SCRIPTS ═══════════════════════════════════ -->
    <script src="{{ asset('user/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('user/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/panel-theme.js') }}" defer></script>

</body>

</html>
