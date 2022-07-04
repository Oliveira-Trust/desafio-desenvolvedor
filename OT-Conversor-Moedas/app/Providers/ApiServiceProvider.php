<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('api', function(){
            return Http::withOptions([
                'verify'        => false,
                'base_uri'      => 'https://economia.awesomeapi.com.br/json'
            ]);
        });
    }
}