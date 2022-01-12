<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Price\Services\PriceService;
use App\Domain\Price\Gateways\AwesomeApiEconomiaGateway;

class PriceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
     public function register()
     {
         $this->app->bind(PriceService::class, function ($app) {
             return new PriceService($app->make(AwesomeApiEconomiaGateway::class));
         });
     }


}
