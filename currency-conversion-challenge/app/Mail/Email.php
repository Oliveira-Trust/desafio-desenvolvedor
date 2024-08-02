<?php

namespace App\Mail;

use App\Models\Conversion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $conversion;

    public function __construct(Conversion $conversion)
    {
        $this->conversion = $conversion;
    }

    public function build()
    {
        return $this->view('email')
            ->subject('Detalhes da Conversão')
            ->with(['conversion' => $this->conversion]);
    }
}
