<?php

namespace App\Providers;

use App\Repository\User\UserIRepository;
use App\Repository\User\implementations\UserRepository;

use App\Repository\Customer\CustomerIRepository;
use App\Repository\Customer\implementations\CustomerRepository;

use App\Repository\Product\ProductIRepository;
use App\Repository\Product\implementations\ProductRepository;

use App\Repository\Product\CategoryIRepository;
use App\Repository\Product\implementations\CategoryRepository;

use App\Repository\Order\OrderIRepository;
use App\Repository\Order\implementations\OrderRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // register the interface class for dependency injection
        $this->app->bind(UserIRepository::class, UserRepository::class);

        $this->app->bind(CustomerIRepository::class, CustomerRepository::class);

        $this->app->bind(ProductIRepository::class, ProductRepository::class);

        $this->app->bind(CategoryIRepository::class, CategoryRepository::class);

        $this->app->bind(OrderIRepository::class, OrderRepository::class);
    }
}