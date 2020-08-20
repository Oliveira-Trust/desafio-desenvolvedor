<?php

namespace App\Listeners;

use App\Events\EventNovoRegistro;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\User;
use App\Mail\EmailRegistroConfirmacao;
use Illuminate\Support\Facades\Mail;

class ListenerConfirmacaoEmail
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
     * @param  EventNovoRegistro  $event
     * @return void
     */
    public function handle(EventNovoRegistro $event)
    {
        Mail::to($event->user)->send(new EmailRegistroConfirmacao($event->user));
    }
}
