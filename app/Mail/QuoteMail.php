<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Mail\Mailable;

class QuoteMail extends Mailable
{
    private ?Quote $quote;

    public function __construct(?Quote $quote)
    {
        $this->quote = $quote;
    }

    public function build()
    {
        $this->from('vitorpmelo20@gmail.com')
            ->to('vitorpmelo00@gmail.com')
            ->subject('Detalhes da Cotação');

        return $this->view('mail.mail', ['data' => $this->quote]);
    }
}