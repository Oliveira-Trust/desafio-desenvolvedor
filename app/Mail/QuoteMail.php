<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;

class QuoteMail extends Mailable
{
    private ?Quote $quote;

    public function __construct(?Quote $quote)
    {
        $this->quote = $quote;
    }

    public function build(): void
    {
        $this->to(Auth::user()->email)
            ->subject('Detalhes da Cotação');

        $this->view('mail.mail', ['data' => $this->quote]);
    }
}