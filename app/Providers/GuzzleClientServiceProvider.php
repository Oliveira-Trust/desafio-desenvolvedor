<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GuzzleClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GuzzleHttp\Client', function($app) {
            return new \GuzzleHttp\Client([
                'base_uri' => $app->make('config')->get('app.external_api')
            ]);
        });
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
