<?php

namespace App\Listeners;

use App\Events\ExchangeCreated;
use App\Mail\ExchangeCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailExchangeCreated
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
    public function handle(ExchangeCreated $event)
    {
        Mail::to(auth()->user()->email)->send(new ExchangeCreatedMail($event->getUserHistory()));
    }
}
