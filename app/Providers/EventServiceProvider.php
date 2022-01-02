<?php

namespace App\Providers;

use Converter\Models\Payment;
use Converter\Observers\PaymentObserver;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
    ];
    public function boot()
    {
        Payment::observe(PaymentObserver::class);
    }
}
