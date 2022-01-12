<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Fee\Strategies\DefaultFee;
use App\Domain\Fee\Repositories\Interfaces\FeeRepositoryInterface;


class DefaultFeeStrategyProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     */
    public function register()
    {
        $this->app->bind(DefaultFee::class, function ($app) {
            return new DefaultFee($app->make(FeeRepositoryInterface::class));
        });
    }
}
