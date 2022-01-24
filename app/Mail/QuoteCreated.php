<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Mail\Mailable;

class QuoteCreated extends Mailable
{
    public function __construct(public Quote $quote)
    {
        //
    }

    public function build()
    {
        return $this->markdown('emails.exchange-quote-created');
    }
}
