<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::bind(
            \App\Repositories\FileUploadRepository::class,
            \App\Repositories\FileUploadRepositoryEloquent::class
        );

        App::bind(
            \App\Repositories\ImportFileRepository::class,
            \App\Repositories\ImportFileRepositoryEloquent::class
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
