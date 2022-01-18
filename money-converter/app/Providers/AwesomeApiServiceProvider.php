<?php

namespace App\Providers;

use App\Libs\Http\Adapters\RedisAdapter;
use App\Libs\Http\AwesomeApi;
use App\Libs\Http\GuzzleCircuitBreaker;
use Illuminate\Support\ServiceProvider;

class AwesomeApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('awesomeapi', function () {
            $adapter = new RedisAdapter();
            $circuit = new GuzzleCircuitBreaker($adapter);

            return new AwesomeApi($circuit);
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
