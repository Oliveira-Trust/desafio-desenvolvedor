<?php

namespace App\Providers;

use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\FeeRepositoryInterface;
use App\Repositories\Contracts\PaymentMethodRepositoryInterface;
use App\Repositories\Contracts\QuotationRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\CurrencyRepository;
use App\Repositories\FeeRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\QuotationRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            CurrencyRepositoryInterface::class,
            CurrencyRepository::class
        );

        $this->app->bind(
            PaymentMethodRepositoryInterface::class,
            PaymentMethodRepository::class
        );

        $this->app->bind(
            FeeRepositoryInterface::class,
            FeeRepository::class
        );

        $this->app->bind(
            QuotationRepositoryInterface::class,
            QuotationRepository::class
        );
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
