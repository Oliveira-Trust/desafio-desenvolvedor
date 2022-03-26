<?php

namespace App\Providers;

use App\View\Composers\CurrencyComposer;
use App\View\Composers\PaymentTypesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.buy-currency-form', CurrencyComposer::class);
        View::composer('components.buy-currency-form', PaymentTypesComposer::class);
    }
}
