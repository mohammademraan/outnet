<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Actions\Fortify\LoginResponse as CustomLoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use App\Actions\Fortify\LogoutResponse as CustomLogoutResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        // Combined sign-in / register page as the default Fortify login page
        Fortify::loginView(function () {
            return view('users.auth', ['mode' => 'login']);
        });

        // Allow login using either email or username (`name` column)
        Fortify::authenticateUsing(function (Request $request) {
            $login = $request->input(Fortify::username()); // typically 'email' field from the form

            $user = User::where('email', $login)
                        ->orWhere('name', $login)
                        ->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Bind custom LoginResponse to redirect users to the application dashboard
        $this->app->singleton(LoginResponseContract::class, CustomLoginResponse::class);
        // Bind custom LogoutResponse to redirect users to the public login page
        $this->app->singleton(LogoutResponseContract::class, CustomLogoutResponse::class);
    }
}
