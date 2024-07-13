<?php

declare(strict_types=1);

namespace App\Providers;

use App\Facades\Excel;
use App\Facades\Helpers;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Helpers::class, fn () => new Helpers());
        $this->app->bind(Excel::class, fn () => new Excel());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
