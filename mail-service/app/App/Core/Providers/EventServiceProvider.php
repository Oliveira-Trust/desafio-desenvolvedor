<?php

namespace App\Core\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Core\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
    ];
}
