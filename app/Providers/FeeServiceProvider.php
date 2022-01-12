<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Fee\Services\FeeService;
use App\Domain\Fee\Repositories\FeeRepository;

class FeeServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     */
    public function register()
    {
        $this->app->bind(FeeService::class, function ($app) {
            return new FeeService($app->make(FeeRepository::class));
        });
    }
}
