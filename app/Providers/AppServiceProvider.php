<?php

namespace App\Providers;

use App\Models\Cotacao;
use App\Observers\CotacaoObservable;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Cotacao::observe(CotacaoObservable::class);
    }
}
