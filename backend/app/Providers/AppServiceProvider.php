<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder; 
use App\Observers\OrderObserver;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // ClientRepository
        $this->app->bind(
            'App\Repositories\Contracts\ClientRepositoryInterface', 
            'App\Repositories\ClientRepository'
        );
        // ProductRepository
        $this->app->bind(
            'App\Repositories\Contracts\ProductRepositoryInterface', 
            'App\Repositories\ProductRepository'
        );
        // OrderRepository
        $this->app->bind(
            'App\Repositories\Contracts\OrderRepositoryInterface', 
            'App\Repositories\OrderRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
        Order::observe(OrderObserver::class);
    }
}
