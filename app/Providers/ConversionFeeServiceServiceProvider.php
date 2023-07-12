<?php


namespace App\Providers;

use App\Services\ConversionFee\ConversionFeeService;
use App\Services\ConversionFee\ConversionFeeServiceContract;
use Illuminate\Support\ServiceProvider;

class ConversionFeeServiceServiceProvider extends ServiceProvider
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
            ConversionFeeServiceContract::class,
            ConversionFeeService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ConversionFeeServiceContract::class];
    }
}
