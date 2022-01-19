<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryPorvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\Contracts\TenantRepository::class, function($app){
            return new \App\Repositories\TenantRepositoryImplementation(new \App\Models\Tenant());
        });

        $this->app->bind(\App\Repositories\Contracts\ConvertedValueRepository::class, function($app){
            return new \App\Repositories\ConvertedValueRepositoryImplementation(new \App\Models\ConvertedValue());
        });
    }
}
