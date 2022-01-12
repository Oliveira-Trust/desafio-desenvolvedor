<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Fee\Strategies\Boleto;
use App\Domain\Fee\Repositories\FeeRepository;

class BoletoStrategyProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Boleto::class, function ($app) {
            return new Boleto($app->make(FeeRepository::class));
        });
    }

}
