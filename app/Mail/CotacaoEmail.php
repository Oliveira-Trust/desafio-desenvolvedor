<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotacaoEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $cotacao;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cotacao)
    {
        $this->cotacao = $cotacao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        // dd($this->details );
        return $this->subject('Cotação de moedas')
                    ->view('emails.cotacao_email');
    }
}
