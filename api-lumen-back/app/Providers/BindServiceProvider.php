<?php

namespace App\Providers;

use App\Repositories\Contracts\ConvertedValueRepository;
use App\Services\ConvertValue\CreateConvertValue\ConvertValueClient;
use App\Services\ConvertValue\CreateConvertValue\ConvertValueInterface;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->createConvertedValueService();
    }

    private function createConvertedValueService()
    {
        $repository = app(ConvertedValueRepository::class);
        $service = new ConvertValueClient();
        $service->setConvertValueRepository($repository);

        $this->app->bind(ConvertValueInterface::class, function() use($service){
            return $service;
        });
    }
}
