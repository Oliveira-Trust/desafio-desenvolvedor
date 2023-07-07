<?php

namespace App\Providers;

use App\Domain\Repositories\ConversionRepositoryInterface;
use App\Http\Infrastructure\Repositories\ConversionRepository;
use App\Domain\Repositories\PaymentMethodRepositoryInterface;
use App\Http\Infrastructure\Repositories\PaymentMethodRepository;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ConversionRepositoryInterface::class, ConversionRepository::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
