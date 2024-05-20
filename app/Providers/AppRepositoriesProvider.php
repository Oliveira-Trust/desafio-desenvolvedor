<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\Currency\CurrencyServiceInterface;
use App\Repositories\Currency\CurrencyServiceRepository;
use App\Interface\User\UserInterface;
use App\Repositories\User\UserRepository;
class AppRepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyServiceInterface::class, CurrencyServiceRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
