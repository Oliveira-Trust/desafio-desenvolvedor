<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Contracts\ConversionRepositoryInterface;
use App\Repositories\AwesomeApi\ConversionRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(ConversionRepositoryInterface::class, ConversionRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
