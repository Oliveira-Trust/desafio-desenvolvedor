<?php

namespace App\Providers;

use App\Repository\User\UserIRepository;
use App\Repository\User\implementations\UserRepository;

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

    }
}