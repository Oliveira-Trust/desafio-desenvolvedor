<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // prevent N+1 Lazy Loading Relationships.
        Model::preventLazyLoading(! $this->app->isProduction());

        // Force SSL in production
        if ($this->app->environment() == 'production') {
            URL::forceScheme('https');
        }
    }
}
