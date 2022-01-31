<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $namespaceAdmin = 'App\Http\Controllers\Admin';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapWebAdminRoutes();
        $this->mapWebCustomersRoutes();
        //
    }

    protected function mapWebCustomersRoutes()
    {
        Route::prefix('customer')
            ->name('customer.')
            ->namespace($this->namespace)
            ->middleware(['web_customers'])
            ->group(base_path('routes/web_customers.php'));
    }

    protected function mapWebAdminRoutes()
    {
        Route::prefix('admin')
            ->name('admin.')
            ->middleware(['web_admin'])
            ->namespace($this->namespaceAdmin)
            ->group(base_path('routes/web_admin.php'));
    }
    protected function mapWebRoutes()
    {
        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
