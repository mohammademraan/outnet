<?php

use App\Http\Controllers\FundsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserValletController;
use Illuminate\Support\Facades\Route;

// ══════════════════════════════════════════════════════════════════════════════
// PUBLIC ROUTES — no authentication required
// ══════════════════════════════════════════════════════════════════════════════

Route::view('/', 'users.index')->name('users.home');
// Combined sign-in / register page (theoutnet pattern) — mode picks the preselected form
Route::get('/user-login', fn () => auth()->check() ? redirect()->route('user.dashboard') : view('users.auth', ['mode' => 'login']))->name('user.login');
Route::get('/user-register', fn () => auth()->check() ? redirect()->route('user.dashboard') : view('users.auth', ['mode' => 'register']))->name('user.register');
Route::get('/register', fn () => auth()->check() ? redirect()->route('user.dashboard') : view('users.auth', ['mode' => 'register']))->name('register');
Route::post('/register', [ProfileController::class, 'userRegisteration'])->name('register.submit');
// Keep legacy route used by the form
Route::post('user-registeration', [ProfileController::class, 'userRegisteration'])->name('user-registeration');

// Public information / marketing pages (only those backed by existing views)
Route::view('/contact-us', 'users.contact')->name('users.contact');
Route::view('/about-us', 'users.about')->name('users.about');
Route::view('/privacy-policy', 'users.privacy')->name('users.privacy');

// ══════════════════════════════════════════════════════════════════════════════
// AUTHENTICATED USER ROUTES — requires login
// ══════════════════════════════════════════════════════════════════════════════

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    // Dashboard (also aliased as data-optimization — controller redirects here)
    Route::get('/user-dashboard', [ProfileController::class, 'show'])->name('user.dashboard');
    Route::get('/data-optimization', [ProfileController::class, 'show'])->name('data-optimization');

    // Profile
    Route::get('/user-profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/user-profile', [UserValletController::class, 'updateProfile'])->name('user.profile.update');

    // Static pages shown inside the authenticated layout
    Route::view('/user-support', 'users.support')->name('user.support');
    Route::view('/user-faqs', 'users.faqs')->name('user.faqs');
    Route::view('/user-company', 'users.company')->name('user.company');
    Route::view('/user-terms', 'users.terms')->name('user.terms');
    Route::get('/user-change-password', fn () => view('users.change-password'))->name('user.change-password');
    Route::put('/user-change-password', [ProfileController::class, 'changeLoginPassword'])->name('user.password.update');
    Route::put('/user-change-wallet-password', [ProfileController::class, 'changeWalletPassword'])->name('user.wallet-password.update');

    // Support alias — controller redirects here when balance < $50 or order overpriced
    Route::get('/support', fn () => view('users.support'))->name('support');

    // Tasks / order history
    Route::get('/user-tasks', [OrdersController::class, 'history'])->name('user.tasks');
    Route::get('/history', [OrdersController::class, 'history'])->name('history');

    // Order generation & submission flow
    Route::get('/generate-order', [OrdersController::class, 'index'])->name('generate.order');
    Route::post('/submit-order', [OrdersController::class, 'submitOrder'])->name('submit.order');
    Route::post('/submit-task', [OrdersController::class, 'processOrder'])->name('submit.task');

    // Wallet
    Route::get('/user-wallet', [ProfileController::class, 'showWalletInformation'])->name('user.wallet');
    Route::get('/wallet-information', [ProfileController::class, 'showWalletInformation'])->name('wallet-information');
    Route::post('/wallet-information', [ProfileController::class, 'storeWalletInformation'])->name('wallet-information.save');

    // Recharge
    Route::get('/user-recharge', [ProfileController::class, 'showBalanceinRecharge'])->name('user.recharge');
    Route::post('/user-recharge', [ProfileController::class, 'storeRecharge'])->name('user.recharge.store');

    // Redemption / Withdrawal
    Route::get('/user-redemption', [ProfileController::class, 'showRedemption'])->name('user.redemption');
    Route::post('/user-redemption', [ProfileController::class, 'redeem'])->name('user.redemption.store');

    // History pages
    Route::get('/user-recharge-history', [ProfileController::class, 'rechargeHistory'])->name('user.recharge-history');
    Route::get('/user-redemption-history', [ProfileController::class, 'redemptionHistory'])->name('user.redemption-history');

    // Jetstream built-in dashboard — redirect to the app's user dashboard
    Route::get('/dashboard', fn () => redirect()->route('user.dashboard'))->name('dashboard');
});

// ══════════════════════════════════════════════════════════════════════════════
// ADMIN ROUTES
// ══════════════════════════════════════════════════════════════════════════════

// ── Public admin routes — no authentication required ──────────────────────────
Route::get('/admin/login',  [MembersController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [MembersController::class, 'login'])->name('admin.login.post');

// ── Protected admin routes — requires admin.auth middleware ───────────────────
// Allows user_type 1 (admin) and user_type 2 (moderator) only.
Route::middleware('admin.auth')->group(function () {

    // Logout
    Route::post('/admin/logout', [MembersController::class, 'logout'])->name('admin.logout');

    // Dashboard entry-point (legacy redirect kept for back-compat)
    Route::get('/administration', fn () => redirect()->route('admin.dashboard'))->name('administration');
    Route::get('/admin/dashboard', [MembersController::class, 'dashboard'])->name('admin.dashboard');

    // Clients
    Route::get('admin/add-client',             [MembersController::class, 'create'])->name('admin.add-client');
    Route::post('admin/add-client',            [MembersController::class, 'store'])->name('admin.add-client.store');
    Route::get('admin/clients',                [MembersController::class, 'index'])->name('admin.clients');
    Route::get('admin/edit-client/{id}',       [MembersController::class, 'edit'])->name('admin.edit-client');
    Route::put('admin/edit-client/{id}',       [MembersController::class, 'update'])->name('admin.edit-client.update');
    Route::post('admin/clients/{user}/reset-todays-orders',
                                               [MembersController::class, 'resetTodaysOrders'])->name('admin.reset-todays-orders');

    // Memberships
    Route::get('admin/memberships',                        [MembershipController::class, 'index'])->name('admin.memberships.index');
    Route::get('admin/memberships/create',                 [MembershipController::class, 'create'])->name('admin.memberships.create');
    Route::post('admin/memberships',                       [MembershipController::class, 'store'])->name('admin.memberships.store');
    Route::get('admin/memberships/{membership}/edit',      [MembershipController::class, 'edit'])->name('admin.memberships.edit');
    Route::put('admin/memberships/{membership}',           [MembershipController::class, 'update'])->name('admin.memberships.update');
    Route::delete('admin/memberships/{membership}',        [MembershipController::class, 'destroy'])->name('admin.memberships.destroy');

    // Order lists
    Route::get('admin/order-lists',                    [OrderListController::class, 'index'])->name('admin.orderlists.index');
    Route::get('admin/order-lists/create',             [OrderListController::class, 'create'])->name('admin.orderlists.create');
    Route::post('admin/order-lists',                   [OrderListController::class, 'store'])->name('admin.orderlists.store');
    Route::get('admin/order-lists/{orderList}/edit',   [OrderListController::class, 'edit'])->name('admin.orderlists.edit');
    Route::put('admin/order-lists/{orderList}',        [OrderListController::class, 'update'])->name('admin.orderlists.update');
    Route::delete('admin/order-lists/{orderList}',     [OrderListController::class, 'destroy'])->name('admin.orderlists.destroy');

    // Funds
    Route::get('admin/clients/{id}/funds/add',                  [FundsController::class, 'index'])->name('admin.funds.add');
    Route::post('admin/clients/funds',                          [FundsController::class, 'store'])->name('admin.funds.store');
    Route::get('admin/clients/{id}/funds/recharge-history',     [FundsController::class, 'rechargeHistory'])->name('admin.funds.recharge');
    Route::get('admin/clients/{id}/funds/redemption-history',   [FundsController::class, 'redemptionHistory'])->name('admin.funds.redemption');
    Route::get('admin/recharge-requests',                       [FundsController::class, 'rechargeRequests'])->name('admin.funds.recharge.requests');
    Route::get('admin/redemption-requests',                     [FundsController::class, 'redemptionRequests'])->name('admin.funds.redemption.requests');
    Route::post('admin/funds/{id}/approve',                     [FundsController::class, 'approve'])->name('admin.funds.approve');
    Route::post('admin/funds/{id}/reject',                      [FundsController::class, 'reject'])->name('admin.funds.reject');

    // Setup / Reset orders
    Route::get('admin/clients/{id}/setup-orders',               [MembersController::class, 'reset_orders'])->name('admin.setup-orders');
    Route::get('admin/clients/{id}/reset-single-order',         [MembersController::class, 'reset_single_order'])->name('admin.reset-single-order');
    Route::post('admin/clients/{id}/update-orders',             [MembersController::class, 'update_orders'])->name('admin.update-orders');
    Route::post('admin/clients/{id}/save-selected-orders',      [MembersController::class, 'saveSelectedOrders'])->name('admin.save-selected-orders');

    // Wallet (admin)
    Route::get('admin/clients/{id}/wallet',         [UserValletController::class, 'index'])->name('admin.wallet');
    Route::get('admin/clients/{id}/wallet/create',  [UserValletController::class, 'create'])->name('admin.wallet.create');
    Route::post('admin/clients/wallet',             [UserValletController::class, 'store'])->name('admin.wallet.store');
    Route::get('admin/clients/{id}/wallet/edit',    [UserValletController::class, 'show'])->name('admin.wallet.edit');
    Route::post('admin/clients/wallet/update',      [UserValletController::class, 'update'])->name('admin.wallet.update');

    // Orders
    Route::get('admin/clients/{id}/orders', [MembersController::class, 'userOrders'])->name('admin.clients.orders');
    Route::get('admin/orders',              [MembersController::class, 'allOrders'])->name('admin.orders');

});
