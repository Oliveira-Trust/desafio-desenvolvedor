<?php

namespace App\Providers;

use App\Services\AwesomeAPI\AwesomeAPIService;
use App\Services\ExchangeService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AwesomeAPIService::class, function ($app) {
            return new AwesomeAPIService();
        });

        $this->app->singleton(ExchangeService::class, function ($app) {
            return new ExchangeService($app->make(AwesomeAPIService::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
