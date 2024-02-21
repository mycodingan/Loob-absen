<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
<<<<<<< HEAD
        Paginator::useBootstrap(); // For Bootstrap 5
        // Paginator::useBootstrapFour(); // For Bootstrap 4
        // Paginator::useBootstrapThree(); // For Bootstrap 3
=======
        Paginator::useBootstrap();
        //
>>>>>>> b533557148a01fc3854e4720c7fcf2eec36b7819
    }
}
