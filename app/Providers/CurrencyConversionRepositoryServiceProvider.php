<?php

namespace App\Providers;

use App\Repositories\CurrencyConversion\CurrencyConversionRepositoryContract;
use App\Repositories\CurrencyConversion\CurrencyConversionRepository;
use Illuminate\Support\ServiceProvider;

class CurrencyConversionRepositoryServiceProvider extends ServiceProvider
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
            CurrencyConversionRepositoryContract::class,
            CurrencyConversionRepository::class
        );

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [CurrencyConversionRepositoryContract::class];
    }
}
