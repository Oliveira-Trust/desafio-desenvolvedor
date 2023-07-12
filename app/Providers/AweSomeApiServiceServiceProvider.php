<?php


namespace App\Providers;

use App\Services\ApiExternal\aweSomeApiService;
use App\Services\ApiExternal\aweSomeApiServiceContract;
use Illuminate\Support\ServiceProvider;

class AweSomeApiServiceServiceProvider extends ServiceProvider
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
            aweSomeApiServiceContract::class,
            aweSomeApiService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [AweSomeApiServiceContract::class];
    }
}
