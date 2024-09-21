<?php

namespace App\Providers;

use App\Models\PersonalAccessToken;
use App\Models\User;
use App\Services\UsuarioService;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
            $this->app->singleton(UsuarioService::class, function($app) {
                    return new UsuarioService(new User());
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
