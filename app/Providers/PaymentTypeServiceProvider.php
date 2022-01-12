<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\PaymentType\Services\PaymentTypeService;
use App\Domain\PaymentType\Repositories\PaymentTypeRepository;

class PaymentTypeServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     */
    public function register()
    {
        $this->app->bind(PaymentTypeService::class, function ($app) {
            return new PaymentTypeService($app->make(PaymentTypeRepository::class));
        });
    }
}
