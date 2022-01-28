<?php

namespace App\Listeners;

use App\Events\CreatePurchase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class SendPurchaseMailNotification
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
     * @param  \App\Events\CreatePurchase  $event
     * @return void
     */
    public function handle(CreatePurchase $event)
    {
        Redis::publish('send-purchase-mail', json_encode($event->purchase()));
    }
}
