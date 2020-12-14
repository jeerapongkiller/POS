<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::if ('admin', function () {
            return auth()->check() && auth()->user()->role == 1;
        });
        Blade::if ('moderator', function () {
            return auth()->check() && auth()->user()->role == 2;
        });
        Blade::if ('outletOwner', function () {
            return auth()->check() && auth()->user()->role == 3;
        });
        Blade::if ('sells', function () {
            return auth()->check() && auth()->user()->role == 4;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
