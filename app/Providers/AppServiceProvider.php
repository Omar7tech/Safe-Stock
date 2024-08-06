<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
        Gate::define('admin', function ($user) {
            return $user->role === "admin";
        });

        Gate::define('user', function ($user) {
            return $user->role === 'user';
        });

        Gate::define('active', function ($user) {
            return $user->active === 'active';
        });

        Paginator::useBootstrap(); // For Bootstrap 5
        // Paginator::useBootstrapFour(); // For Bootstrap 4
        // Paginator::useBootstrapThree(); // For Bootstrap 3

    }
}
