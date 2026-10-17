<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(191);

        if (str_starts_with((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        // Redirect unauthenticated guests to the register page instead of login,
        // passing the intended URL as a ?redirect= param so the flow continues
        // after they register (or log in via the "Already registered?" link).
        Authenticate::redirectUsing(function ($request) {
            if ($request->expectsJson()) {
                return null;
            }

            return route('register').'?redirect='.urlencode($request->fullUrl());
        });
    }
}
