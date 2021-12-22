<?php

namespace App\Providers;

use DirectoryIterator;
use Illuminate\Support\ServiceProvider;

/**
 * ModularizationServiceProvider
 * Providers necessário para carregar modulos 
 */
class ModularizationServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom('app/Modules/*/database/migrations');

        $modules = new DirectoryIterator(__DIR__ . '/../Modules');

        foreach ($modules as $module) {

            if(is_readable($module->getRealPath() . '/routes/web.php')) {

                $this->loadRoutesFrom(__DIR__ . "/../Modules/{$module->getBasename()}/routes/web.php");
            }
        }
    }
}
