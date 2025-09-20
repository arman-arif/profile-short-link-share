<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
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
        Paginator::useBootstrapFive();

        RateLimiter::for('login', function ($request) {
            return [
                // Block after 3 attempts in 15 minutes
                Limit::perMinutes(2, 3)->by($request->ip()),

                // Block after 6 attempts in 45 minutes
                Limit::perMinutes(3, 6)->by($request->ip()),
            ];
        });
    }
}
