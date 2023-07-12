<?php

namespace App\Providers;

use App\Repositories\ConversionFee\ConversionFeeRepositoryContract;
use App\Repositories\ConversionFee\ConversionFeeRepository;
use Illuminate\Support\ServiceProvider;

class ConversionFeeRepositoryServiceProvider extends ServiceProvider
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
            ConversionFeeRepositoryContract::class,
            ConversionFeeRepository::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ConversionFeeRepositoryContract::class];
    }
}
