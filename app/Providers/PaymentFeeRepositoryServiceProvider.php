<?php

namespace App\Providers;

use App\Repositories\PaymentFee\PaymentFeeRepositoryContract;
use App\Repositories\PaymentFee\PaymentFeeRepository;
use Illuminate\Support\ServiceProvider;

class PaymentFeeRepositoryServiceProvider extends ServiceProvider
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
            PaymentFeeRepositoryContract::class,
            PaymentFeeRepository::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [PaymentFeeRepositoryContract::class];
    }
}
