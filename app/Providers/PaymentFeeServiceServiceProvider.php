<?php


namespace App\Providers;

use App\Services\PaymentFee\PaymentFeeService;
use App\Services\PaymentFee\PaymentFeeServiceContract;
use Illuminate\Support\ServiceProvider;

class PaymentFeeServiceServiceProvider extends ServiceProvider
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
            PaymentFeeServiceContract::class,
            PaymentFeeService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [PaymentFeeServiceContract::class];
    }
}
