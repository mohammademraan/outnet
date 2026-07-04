<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Funds;
use App\Models\Orders;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Provide commonly-used dynamic data to the `layouts.user` master view
        View::composer('layouts.user', function ($view) {
            $user = Auth::user();

            $defaults = [
                'tasksCount' => 0,
                'balance' => 0,
                'notificationsCount' => 0,
                'membershipLabel' => 'Bronze',
            ];

            if (! $user) {
                $view->with($defaults);
                return;
            }

            // Compute counts and balance (safe defaults)
            $tasksCount = Orders::where('user_id', $user->id)
                                ->where('status', 'active')
                                ->count();

            // Skip querying the `notifications` table for now (may not exist in DB)
            $notificationsCount = 0;

            $totalCommission = Funds::where('user_id', $user->id)->where('type', 'commission')->whereIn('status', ['active', 'deactive'])->sum('amount');
            $totalDeposit    = Funds::where('user_id', $user->id)->where('type', 'deposit')    ->whereIn('status', ['active', 'deactive'])->sum('amount');
            $totalWithdraw   = Funds::where('user_id', $user->id)->where('type', 'withdrawal') ->whereIn('status', ['active', 'deactive'])->sum('amount');

            // Follow ProfileController::index logic: totalFunds = deposits + commission - withdrawals
            $totalFunds = $totalDeposit + $totalCommission - $totalWithdraw;

            // Subtract the first incomplete order's price (if any, and active)
            $firstIncompleteOrder = Orders::where('user_id', $user->id)
                ->where('type', 'Incomplete')
                ->where('status', 'active')
                ->with('orderList')
                ->first();

            if ($firstIncompleteOrder) {
                $orderPrice = optional($firstIncompleteOrder->orderList)->price ?? 0;
                $totalFunds -= $orderPrice;
            }

            $balance = $totalFunds;

            // Resolve membership label from relation if available
            $membershipLabel = 'Bronze';
            if (isset($user->membershipLevel) && $user->membershipLevel) {
                // memberships table uses `level_name`
                $levelName = strtolower($user->membershipLevel->level_name ?? $user->membership_level ?? 'bronze');
                if ($levelName === 'diamond') $membershipLabel = 'Diamond';
                elseif ($levelName === 'gold') $membershipLabel = 'Gold Member';
                elseif ($levelName === 'silver') $membershipLabel = 'Silver Member';
                else $membershipLabel = ucfirst($levelName) . ' Member';
            }

            $view->with([
                'tasksCount' => $tasksCount,
                'balance' => $balance,
                'notificationsCount' => $notificationsCount,
                'membershipLabel' => $membershipLabel,
            ]);
        });
    }
}
