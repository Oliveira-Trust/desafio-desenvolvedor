<?php

namespace App\Providers;

use App\Repositories\CotationRepository;
use App\Repositories\SettingRepository;
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
        $this->app->bind(CotationRepository::class, function ($app) {
            return new CotationRepository();
        });

        $this->app->bind(SettingRepository::class, function ($app) {
            return new SettingRepository();
        });
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
