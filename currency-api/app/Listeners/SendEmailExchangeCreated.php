<?php

namespace App\Listeners;

use App\Events\ExchangeCreated;
use App\Mail\ExchangeCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendEmailExchangeCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() { }

    /**
     * Handle the event.
     *
     * @param  ExchangeCreated $event
     * @return void
     */
    public function handle(ExchangeCreated $event): void
    {
        Mail::to(auth()->user()->email)->send(new ExchangeCreatedMail($event->getUserConversion()));
    }
}
