<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use app\Services\CustomerService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind CustomerService as a singleton
        $this->app->singleton(CustomerService::class, function ($app) {
            return new CustomerService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
