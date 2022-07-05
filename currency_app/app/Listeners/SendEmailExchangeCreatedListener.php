<?php

namespace App\Listeners;

use App\Events\ExchangeCreatedEvent;
use App\Mail\ExchangeCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailExchangeCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ExchangeCreatedEvent $event)
    {
        Mail::to('david.desenvolvedor@gmail.com')->send(new ExchangeCreatedMail($event->getUserHistory()));
    }
}
