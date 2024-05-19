<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\Currency\CurrencyServiceInterface;
use App\Repositories\Currency\CurrencyServiceRepository;
class AppRepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyServiceInterface::class, CurrencyServiceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
