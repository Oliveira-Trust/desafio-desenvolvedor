<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyCurrency extends Mailable
{
    use Queueable, SerializesModels;

    private $currencyData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($currencyData)
    {
        $this->currencyData = $currencyData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.buy-currency');
    }
}
