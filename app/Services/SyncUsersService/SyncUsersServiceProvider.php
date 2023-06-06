<?php

namespace App\Services\SyncUsersService;

use Illuminate\Support\ServiceProvider;

class SyncUsersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton('sync_users', function () {
            return new SyncUsersService();
        });
    }
}
