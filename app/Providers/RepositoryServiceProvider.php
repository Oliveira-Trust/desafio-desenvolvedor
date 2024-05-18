<?php

namespace App\Providers;

use App\Repositories\Api\CurrencyConversionRepository;
use App\Repositories\CurrencyConversionContractRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyConversionContractRepository::class, CurrencyConversionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
