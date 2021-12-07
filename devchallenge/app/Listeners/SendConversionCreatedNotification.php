<?php

namespace App\Listeners;

use App\Events\ConversionHistoryCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ConversionLog;
use Illuminate\Support\Facades\Mail;

class SendConversionCreatedNotification
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
     * @param  \App\Events\ConversionHistoryCreated  $event
     * @return void
     */
    public function handle(ConversionHistoryCreated $event)
    {
        Mail::to($event->user->email)->send(
            new ConversionLog($event->user, $event->conversion)
        );
    }
}
