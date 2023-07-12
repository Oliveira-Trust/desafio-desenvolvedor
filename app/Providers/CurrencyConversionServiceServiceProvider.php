<?php


namespace App\Providers;

use App\Services\CurrencyConversion\CurrencyConversionService;
use App\Services\CurrencyConversion\CurrencyConversionServiceContract;
use Illuminate\Support\ServiceProvider;

class CurrencyConversionServiceServiceProvider extends ServiceProvider
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
            CurrencyConversionServiceContract::class,
            CurrencyConversionService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [CurrencyConversionServiceContract::class];
    }
}
