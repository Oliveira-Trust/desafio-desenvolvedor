<?php


namespace App\Providers;

use App\Services\User\UserService;
use App\Services\User\UserServiceContract;
use Illuminate\Support\ServiceProvider;

class UserServiceServiceProvider extends ServiceProvider
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
            UserServiceContract::class,
            UserService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [UserServiceContract::class];
    }
}
