<?php

namespace App\Mail;

use App\Models\Exchange;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExchangeCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private Exchange $exchange)
    { }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.exchange_created', [
            'exchange' => $this->exchange
        ]);
    }
}