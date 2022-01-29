<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CurrencyTradeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fields;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fields)
    {
         $this->fields = $fields;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Cotação de compra de moeda estrangeira')
                    ->view('emails.currencyTrade');
    }
}
