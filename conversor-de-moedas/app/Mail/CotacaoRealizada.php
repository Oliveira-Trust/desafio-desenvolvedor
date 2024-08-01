<?php

// App\Mail\CotacaoRealizada.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotacaoRealizada extends Mailable
{
    use Queueable, SerializesModels;

    public $dadosCotacao;

    public function __construct($dadosCotacao)
    {
        $this->dadosCotacao = $dadosCotacao;
    }

    public function build()
    {
        return $this->view('emails.cotacao_realizada_via_email')
                    ->with('dadosCotacao', $this->dadosCotacao);
    }
}
