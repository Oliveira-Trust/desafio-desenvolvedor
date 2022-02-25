<?php

namespace App\Mail;

use App\Models\PriceQuote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendConverterResult extends Mailable
{
    use Queueable, SerializesModels;

    public PriceQuote $price_quote;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\PriceQuote  $history
     * @return void
     */
    public function __construct(PriceQuote $price_quote)
    {
        $this->price_quote = $price_quote;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cotação')
            ->view('mails.html.price-quote')
            ->text('mails.plain.price-quote');
    }
}
