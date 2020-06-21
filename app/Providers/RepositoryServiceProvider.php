<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\IUserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IBaseRepository::class, 
            BaseRepository::class
        );
        $this->app->bind(
            IUserRepository::class, 
            UserRepository::class
        );
        $this->app->bind(
            IStatusRepository::class, 
            StatusRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
