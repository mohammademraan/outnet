<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') – Fashion Nova</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Space+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/app/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/appcss/pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    @stack('styles')
</head>

<body>

    {{-- SIDEBAR OVERLAY (mobile) --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-mark">
                <div class="logo-icon">RM</div>
                <div class="logo-text">Realty<span>Mogul</span></div>
            </div>
        </div>

        <div class="sidebar-user">
            <a href="{{ route('user.profile') }}"
                style="display:flex;gap:12px;align-items:center;text-decoration:none;color:inherit;">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
                <div class="user-info">
                    <div class="name">{{ auth()->user()->name ?? 'User' }}</div>
                    <div class="level">
                        {{ $membershipLabel ?? ucfirst(auth()->user()->membership_level ?? 'Bronze') }}
                    </div>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main Menu</div>

            <a href="{{ route('user.dashboard') }}"
                class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">🏠</span>
                <span class="nav-label">Dashboard</span>
            </a>

            <a href="{{ route('user.tasks') }}" class="nav-item {{ request()->routeIs('user.tasks') ? 'active' : '' }}">
                <span class="nav-icon">📋</span>
                <span class="nav-label">Tasks</span>
                <span class="nav-badge">{{ $tasksCount ?? 0 }}</span>
            </a>

            <div class="nav-section-label">Finance</div>

            <a href="{{ route('user.wallet') }}"
                class="nav-item {{ request()->routeIs('user.wallet') ? 'active' : '' }}">
                <span class="nav-icon">💼</span>
                <span class="nav-label">Wallet</span>
            </a>

            <a href="{{ route('user.recharge') }}"
                class="nav-item {{ request()->routeIs('user.recharge') ? 'active' : '' }}">
                <span class="nav-icon">📥</span>
                <span class="nav-label">Recharge</span>
            </a>

            <a href="{{ route('user.redemption') }}"
                class="nav-item {{ request()->routeIs('user.redemption') ? 'active' : '' }}">
                <span class="nav-icon">📤</span>
                <span class="nav-label">Redemption</span>
            </a>

            <a href="{{ route('user.tasks') }}"
                class="nav-item {{ request()->routeIs('user.history') ? 'active' : '' }}">
                <span class="nav-icon">📊</span>
                <span class="nav-label">History</span>
            </a>

            <a href="{{ route('user.recharge-history') }}"
                class="nav-item {{ request()->routeIs('user.recharge-history') ? 'active' : '' }}">
                <span class="nav-icon">📥</span>
                <span class="nav-label">Recharge History</span>
            </a>

            <a href="{{ route('user.redemption-history') }}"
                class="nav-item {{ request()->routeIs('user.redemption-history') ? 'active' : '' }}">
                <span class="nav-icon">📤</span>
                <span class="nav-label">Redemption History</span>
            </a>

            <div class="nav-section-label">Support</div>

            <a href="{{ route('user.support') }}"
                class="nav-item {{ request()->routeIs('user.support') ? 'active' : '' }}">
                <span class="nav-icon">🎧</span>
                <span class="nav-label">Support</span>
            </a>

            <a href="{{ route('user.faqs') }}" class="nav-item {{ request()->routeIs('user.faqs') ? 'active' : '' }}">
                <span class="nav-icon">❓</span>
                <span class="nav-label">FAQs</span>
            </a>

            <div class="nav-section-label">Company</div>

            <a href="{{ route('user.company') }}"
                class="nav-item {{ request()->routeIs('user.company') ? 'active' : '' }}">
                <span class="nav-icon">🏢</span>
                <span class="nav-label">Company</span>
            </a>

            <a href="{{ route('user.terms') }}"
                class="nav-item {{ request()->routeIs('user.terms') ? 'active' : '' }}">
                <span class="nav-icon">📜</span>
                <span class="nav-label">Terms</span>
            </a>

            <div class="nav-section-label">Account</div>

            <a href="{{ route('user.profile') }}"
                class="nav-item {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <span class="nav-icon">👤</span>
                <span class="nav-label">Profile</span>
            </a>

            <a href="{{ route('user.change-password') }}"
                class="nav-item {{ request()->routeIs('user.change-password') ? 'active' : '' }}">
                <span class="nav-icon">🔑</span>
                <span class="nav-label">Change Password</span>
            </a>

            <div style="padding:16px 24px 24px;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-sm" style="width:100%;justify-content:center;">🚪
                        Sign Out</button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- MAIN WRAPPER --}}
    <div class="main-wrapper app-main">

        {{-- TOPBAR --}}
        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger" id="hamburgerBtn" aria-label="Toggle menu">☰</button>
                <div class="page-title">@yield('page-title', 'Dashboard')</div>
            </div>
            <div class="topbar-right">
                <div class="topbar-balance">
                    <div>
                        <div class="bal-label">Balance</div>
                        <div class="bal-amount" style="font-family:'Space Mono',monospace;">
                            ${{ number_format($balance ?? (auth()->user()->balance ?? 0), 2) }}</div>
                    </div>
                </div>

                {{-- Notification Bell --}}
                <div class="topbar-icon-btn notif-btn" id="notifBtn" title="Notifications"
                    style="position:relative;">
                    🔔
                    <span class="notif-dot"
                        style="position:absolute;top:4px;right:4px;width:8px;height:8px;background:var(--danger);border-radius:50%;border:2px solid var(--dark2);"></span>
                    <span
                        style="position:absolute;top:2px;right:2px;background:var(--danger);color:#fff;font-size:9px;font-weight:700;border-radius:10px;padding:1px 4px;min-width:14px;text-align:center;">{{ $notificationsCount ?? 0 }}</span>
                </div>

                {{-- User Dropdown --}}
                <div class="topbar-user-wrap" style="position:relative;">
                    <div class="topbar-icon-btn" id="userMenuBtn"
                        style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--accent));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;cursor:pointer;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="dropdown-menu" id="userDropdown"
                        style="display:none;position:absolute;top:48px;right:0;background:var(--card);border:1px solid var(--border);border-radius:var(--radius);min-width:180px;z-index:200;box-shadow:var(--shadow);overflow:hidden;">
                        <div style="padding:12px 16px;border-bottom:1px solid var(--border);">
                            <div style="font-weight:600;font-size:13px;"><a href="{{ route('user.profile') }}"
                                    style="color:inherit;text-decoration:none;">{{ auth()->user()->name ?? 'User' }}</a>
                            </div>
                            <div style="font-size:11px;color:var(--text-muted);">{{ auth()->user()->email ?? '' }}
                            </div>
                        </div>
                        <a href="{{ route('user.profile') }}"
                            style="display:flex;align-items:center;gap:10px;padding:11px 16px;font-size:13px;color:var(--text);text-decoration:none;transition:background 0.15s;"
                            onmouseover="this.style.background='rgba(108,71,255,0.1)'"
                            onmouseout="this.style.background='transparent'">👤 Profile</a>
                        <a href="{{ route('user.change-password') }}"
                            style="display:flex;align-items:center;gap:10px;padding:11px 16px;font-size:13px;color:var(--text);text-decoration:none;transition:background 0.15s;"
                            onmouseover="this.style.background='rgba(108,71,255,0.1)'"
                            onmouseout="this.style.background='transparent'">🔑 Change Password</a>
                        <div style="border-top:1px solid var(--border);">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    style="width:100%;display:flex;align-items:center;gap:10px;padding:11px 16px;font-size:13px;color:var(--danger);background:none;border:none;cursor:pointer;transition:background 0.15s;"
                                    onmouseover="this.style.background='rgba(255,71,87,0.08)'"
                                    onmouseout="this.style.background='transparent'">🚪 Sign Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- FLASH MESSAGES --}}
        @php
            /* Collect all flash messages the controller may set, normalise to [bg, icon, text] */
            $__flashes = [];
            if (session('success')) {
                $__flashes[] = ['var(--success)', '✅', session('success')];
            }
            if (session('order_success_message')) {
                $__flashes[] = ['var(--success)', '✅', session('order_success_message')];
            }
            if (session('order_message')) {
                $__flashes[] = ['var(--primary)', 'ℹ️', session('order_message')];
            }
            if (session('error')) {
                $__flashes[] = ['var(--danger)', '❌', session('error')];
            }
            if (session('account_message')) {
                $__flashes[] = ['var(--danger)', '🚫', session('account_message')];
            }
            if (session('blc_message')) {
                $__flashes[] = ['var(--warning)', '⚠️', session('blc_message')];
            }
            if (session('account_notice')) {
                $__flashes[] = ['var(--warning)', '⚠️', session('account_notice')];
            }
        @endphp

        @if (!empty($__flashes))
            <div id="flashStack"
                style="position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:10px;max-width:360px;">
                @foreach ($__flashes as $__i => $__f)
                    <div id="flash_{{ $__i }}"
                        style="background:{{ $__f[0] }};color:#fff;padding:14px 18px;border-radius:var(--radius-sm);font-size:13.5px;font-weight:600;box-shadow:var(--shadow);display:flex;align-items:center;gap:10px;animation:slideInUp 0.3s ease;">
                        <span style="font-size:16px;flex-shrink:0;">{{ $__f[1] }}</span>
                        <span style="flex:1;line-height:1.45;">{{ $__f[2] }}</span>
                        <button onclick="this.parentElement.remove()"
                            style="background:none;border:none;color:#fff;cursor:pointer;font-size:18px;line-height:1;flex-shrink:0;opacity:0.8;">×</button>
                    </div>
                @endforeach
            </div>
            <script>
                (function() {
                    var count = {{ count($__flashes) }};
                    for (var i = 0; i < count; i++) {
                        (function(id) {
                            setTimeout(function() {
                                var el = document.getElementById('flash_' + id);
                                if (el) {
                                    el.style.transition = 'opacity 0.4s, transform 0.4s';
                                    el.style.opacity = '0';
                                    el.style.transform = 'translateY(8px)';
                                    setTimeout(function() {
                                        if (el) el.remove();
                                    }, 400);
                                }
                            }, 5000 + id * 300);
                        })(i);
                    }
                })();
            </script>
        @endif

        {{-- MAIN CONTENT --}}
        <main class="content">
            @yield('content')
        </main>

    </div>

    {{-- TOAST CONTAINER --}}
    <div id="toastContainer"
        style="position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:10px;"></div>

    <script src="{{ asset('user/app/js/app.js') }}"></script>
    <script src="{{ asset('user/appjs/pages.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hamburger / sidebar toggle
            const hamburger = document.getElementById('hamburgerBtn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (hamburger) {
                hamburger.addEventListener('click', function() {
                    sidebar.classList.toggle('sidebar-open');
                    overlay.classList.toggle('active');
                });
            }
            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('sidebar-open');
                    overlay.classList.remove('active');
                });
            }

            // User dropdown toggle
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userDropdown = document.getElementById('userDropdown');
            if (userMenuBtn && userDropdown) {
                userMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.style.display = userDropdown.style.display === 'none' ? 'block' : 'none';
                });
                document.addEventListener('click', function() {
                    userDropdown.style.display = 'none';
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
