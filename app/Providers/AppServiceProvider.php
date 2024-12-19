<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Database\Factories\PermissionFactory;
use Spatie\Permission\Models\Permission;

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


    public function boot()
    {

    }


}
