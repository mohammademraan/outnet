<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Allows user_type 1 (admin) and user_type 2 (moderator).
     * Blocks everything else and redirects to the admin login page.
     */
    public function handle(Request $request, Closure $next)
    {
        // Not logged in at all
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Please log in to access the admin panel.');
        }

        $user = Auth::user();

        // Account must be active
        if ($user->status !== 'active') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login')
                ->with('error', 'Your account has been deactivated. Contact support.');
        }

        // Only admin (1) and moderator (2) are allowed
        if (!in_array($user->user_type, [1, 2])) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login')
                ->with('error', 'You do not have permission to access the admin panel.');
        }

        return $next($request);
    }
}
