<?php

namespace App\Providers;

use App\Database\Schema\Schema;
use Illuminate\Contracts\Foundation\ExceptionRenderer;
use Illuminate\Foundation\Exceptions\Whoops\WhoopsExceptionRenderer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(ExceptionRenderer::class, WhoopsExceptionRenderer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Paginator::useBootstrap();
    }
}
