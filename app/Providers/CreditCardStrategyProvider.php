<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Fee\Strategies\CreditCard;
use App\Domain\Fee\Repositories\FeeRepository;

class CreditCardStrategyProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CreditCard::class, function ($app) {
            return new CreditCard($app->make(FeeRepository::class));
        });
    }

}
