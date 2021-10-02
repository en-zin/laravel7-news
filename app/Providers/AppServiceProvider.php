<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // use charset "utf8mb4" on cleardb
        Schema::defaultStringLength(191);

        // rewrite schema for getting assets
        if (request()->isSecure()) {
            URL::forceScheme('https');
        }
    }
}
