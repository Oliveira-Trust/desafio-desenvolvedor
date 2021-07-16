<?php

namespace App\Providers;

use App\Repository\User\UserIRepository;
use App\Repository\User\implementations\UserRepository;

use App\Repository\Customer\CustomerIRepository;
use App\Repository\Customer\implementations\CustomerRepository;

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
    }
}