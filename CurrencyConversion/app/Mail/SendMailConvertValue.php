<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailConvertValue extends Mailable
{
    use Queueable, SerializesModels;


    public $ConvertValue;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ConvertValue)
    {
        $this->ConvertValue = $ConvertValue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Segue sua cotação')
        ->view('CurrencyConversion.Email');
    }
}
