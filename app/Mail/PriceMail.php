<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PriceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $prices;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($prices)
    {
        $this->prices = $prices;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Teste de envio')->view('emails.price');
    }
}
