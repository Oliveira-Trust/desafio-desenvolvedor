
<?php
// app/Providers/CurrencyApiProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Gateways\CurrencyApiGateway;
use GuzzleHttp\Client;

class CurrencyApiProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CurrencyApiGateway::class, function($app) {
            $client = new Client([
                'base_uri' => config('currency_api.base_uri'),
                'timeout'  => config('currency_api.timeout'),
            ]);
            
            return new CurrencyApiGateway($client);
        });
    }
}
