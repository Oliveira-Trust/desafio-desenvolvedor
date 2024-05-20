<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\Currency\CurrencyServiceInterface;
use App\Repositories\Currency\CurrencyServiceRepository;
use App\Interface\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Interface\Quote\HistoricalQuoteInterface;
use App\Repositories\Quote\HistoricalQuoteRepository;
class AppRepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyServiceInterface::class, CurrencyServiceRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(HistoricalQuoteInterface::class, HistoricalQuoteRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
