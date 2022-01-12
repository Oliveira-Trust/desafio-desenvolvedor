<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Currency\Services\CurrencyService;
use App\Domain\Currency\Repositories\CurrencyRepository;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     */
    public function register()
    {
        $this->app->bind(CurrencyService::class, function ($app) {
            return new CurrencyService($app->make(CurrencyRepository::class));
        });
    }
}
