<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
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
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        $this->app->bind(\App\Repositories\Contracts\ConvertedValueRepository::class, function($app){
            return new \App\Repositories\ConvertedValueRepositoryImplementation(new \App\Models\CurrencyConversion());
        });
    }
}
