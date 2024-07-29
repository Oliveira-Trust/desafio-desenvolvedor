<?php

namespace App\Providers;

use App\Services\CurrencyConversionService;
use GuzzleHttp\Client;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CurrencyConversionService::class, function ($app) {
            return new CurrencyConversionService(new Client());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('auth', Authenticate::class);
        
    }
}
