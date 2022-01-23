<?php

namespace App\Providers;

use App\Repositories\Contracts\ConvertedValueRepository;
use App\Services\ConvertValue\ConvertValueClient;
use App\Services\ConvertValue\ConvertValueInterface;
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
        $this->updateConvertedValueService();
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
    
    private function updateConvertedValueService()
    {
        $repository = app(ConvertedValueRepository::class);
        $service = new ConvertValueClient();
        $service->setConvertValueRepository($repository);

        $this->app->bind(ConvertValueInterface::class, function() use($service){
            return $service;
        });
    }
}
