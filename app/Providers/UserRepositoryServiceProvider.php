<?php

namespace App\Providers;

use App\Repositories\User\UserRepositoryContract;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryContract::class,
            UserRepository::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [UserRepositoryContract::class];
    }
}
