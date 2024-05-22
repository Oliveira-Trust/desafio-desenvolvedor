<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Quote\QuoteService;
use App\Interface\Quote\QuoteServiceInterface;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QuoteServiceInterface::class, QuoteService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
