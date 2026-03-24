<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
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
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->string('email')->lower()->trim();

            return Limit::perMinute(5)->by($email . '|' . $request->ip());
        });

        RateLimiter::for('uploads', function (Request $request) {
            $userKey = (string) ($request->user()?->getAuthIdentifier() ?? 'guest');
            $key = $userKey . '|' . $request->ip();

            return [
                Limit::perMinute(3)->by('uploads:minute:' . $key),
                Limit::perDay(25)->by('uploads:day:' . $key),
            ];
        });

        RateLimiter::for('uploads-index', function (Request $request) {
            $userKey = (string) ($request->user()?->getAuthIdentifier() ?? 'guest');
            $key = $userKey . '|' . $request->ip();

            return Limit::perMinute(30)->by('uploads-index:' . $key);
        });

        RateLimiter::for('market-data', function (Request $request) {
            $userKey = (string) ($request->user()?->getAuthIdentifier() ?? 'guest');
            $key = $userKey . '|' . $request->ip();

            return [
                Limit::perMinute(5)->by('market-data:minute:' . $key),
                Limit::perHour(100)->by('market-data:hour:' . $key),
            ];
        });
    }
}
