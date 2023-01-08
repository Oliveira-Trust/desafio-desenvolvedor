<?php

namespace App\Providers;

use App\Contracts\CurrencyRepositoryInterface;
use App\Contracts\ExchangeRepositoryInterface;
use App\Contracts\FeeRepositoryInterface;
use App\Contracts\PaymentMethodRepositoryInterface;
use App\Repositories\CurrencyRepository;
use App\Repositories\ExchangeRepository;
use App\Repositories\FeeRepository;
use App\Repositories\PaymentMethodRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind(ExchangeRepositoryInterface::class, ExchangeRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(FeeRepositoryInterface::class, FeeRepository::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
    }

}
