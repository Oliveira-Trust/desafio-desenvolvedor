<?php

namespace App\Listeners;

use App\Events\EmailSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailCotation
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
     * @param  \App\Events\EmailSent  $event
     * @return void
     */
    public function handle(EmailSent $event)
    {
        $user = $event->user;
        $message = $event->message;

        Mail::to($user)->send($message);
   
    }
}
