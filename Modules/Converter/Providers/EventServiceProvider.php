<?php

namespace Modules\Converter\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Converter\Entities\ConversionHistory;
use Modules\Converter\Observers\ConversionHistoryObserver;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Register any events for your module.
     */
    public function boot(): void
    {
        ConversionHistory::observe(ConversionHistoryObserver::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
