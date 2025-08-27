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
            \App\Repositories\UploadFileRepository::class,
            \App\Repositories\UploadFileRepositoryEloquent::class
        );

        App::bind(
            \App\Repositories\ImportDataFileRepository::class,
            \App\Repositories\ImportDataFileRepositoryEloquent::class
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
