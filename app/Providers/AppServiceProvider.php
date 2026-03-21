<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domains\User\Application\Ports\UserRepository::class,
            \App\Domains\User\Infrastructure\Persistence\Eloquent\EloquentUserRepository::class
        );

        $this->app->bind(
            \App\Domains\User\Application\Ports\PasswordHasher::class,
            \App\Domains\User\Infrastructure\Security\BcryptPasswordHasher::class
        );

        $this->app->bind(
            \App\Domains\User\Application\Ports\TokenIssuer::class,
            \App\Domains\User\Infrastructure\Auth\SanctumTokenIssuer::class
        );

        $this->app->bind(
            \App\Domains\Upload\Application\Ports\UploadRepository::class,
            \App\Domains\Upload\Infrastructure\Persistence\Eloquent\EloquentUploadRepository::class
        );

        $this->app->bind(
            \App\Domains\Upload\Application\Ports\UploadStorage::class,
            \App\Domains\Upload\Infrastructure\Storage\LocalUploadStorage::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
