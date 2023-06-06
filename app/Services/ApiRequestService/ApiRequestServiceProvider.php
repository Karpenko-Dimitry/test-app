<?php

namespace App\Services\ApiRequestService;

use Illuminate\Support\ServiceProvider;

class ApiRequestServiceProvider extends ServiceProvider
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
        $this->app->singleton('api_request', function () {
            return new ApiRequestService();
        });
    }
}
