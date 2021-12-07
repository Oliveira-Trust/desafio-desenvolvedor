<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConversionLog extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $conversion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $conversion)
    {
        $this->user = $user;
        $this->conversion = $conversion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.conversion-log');
    }
}
