<?php

namespace App\Providers;

use App\Domains\Exchange\Interfaces\IExchangeConvert;
use App\Domains\Exchange\Libraries\AwesomeAPI;
use Illuminate\Support\ServiceProvider;

class ExchangeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->bind(IExchangeConvert::class, function () {
            return new AwesomeAPI(env("EXCHANGE_API_URL"), env("EXCHANGE_API_MAP_SLUG"));
        });
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
