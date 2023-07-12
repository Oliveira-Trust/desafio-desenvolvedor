<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CurrencyConversion;
use App\Observers\CurrencyConversionObserver;
use App\Repositories\ConversionFee\ConversionFeeRepository;
use App\Repositories\ConversionFee\ConversionFeeRepositoryContract;
use App\Repositories\CurrencyConversion\CurrencyConversionRepository;
use App\Repositories\CurrencyConversion\CurrencyConversionRepositoryContract;
use App\Repositories\PaymentFee\PaymentFeeRepository;
use App\Repositories\PaymentFee\PaymentFeeRepositoryContract;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryContract;
use App\Services\ApiExternal\aweSomeApiService;
use App\Services\ApiExternal\aweSomeApiServiceContract;
use App\Services\ConversionFee\ConversionFeeService;
use App\Services\ConversionFee\ConversionFeeServiceContract;
use App\Services\CurrencyConversion\CurrencyConversionService;
use App\Services\CurrencyConversion\CurrencyConversionServiceContract;
use App\Services\PaymentFee\PaymentFeeService;
use App\Services\PaymentFee\PaymentFeeServiceContract;
use App\Services\User\UserService;
use App\Services\User\UserServiceContract;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserServiceContract::class, UserService::class);

        $this->app->bind(PaymentFeeRepositoryContract::class, PaymentFeeRepository::class);
        $this->app->bind(PaymentFeeServiceContract::class, PaymentFeeService::class);

        $this->app->bind(ConversionFeeRepositoryContract::class, ConversionFeeRepository::class);
        $this->app->bind(ConversionFeeServiceContract::class, ConversionFeeService::class);

        $this->app->bind(CurrencyConversionRepositoryContract::class, CurrencyConversionRepository::class);
        $this->app->bind(CurrencyConversionServiceContract::class, CurrencyConversionService::class);

        $this->app->bind(aweSomeApiServiceContract::class, aweSomeApiService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        CurrencyConversion::observe(CurrencyConversionObserver::class);
    }
}
