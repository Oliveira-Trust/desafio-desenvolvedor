<?php

namespace App\Providers;

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
        // Call ClientRepository
        $this->app->bind(
            'App\Repository\Contracts\ClientRepositoryInterface',
            'App\Repository\ClientRepository'
        );
        // Call ProductRepository
        $this->app->bind(
            'App\Repository\Contracts\ProductRepositoryInterface',
            'App\Repository\ProductRepository'
        );
        // Call PurchaseRepository
        $this->app->bind(
            'App\Repository\Contracts\PurchaseRepositoryInterface',
            'App\Repository\PurchaseRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
