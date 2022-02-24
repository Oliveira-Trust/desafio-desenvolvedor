<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotacaoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $moedaDestino;
    public $valorComprado;
    public $totalDescontato;
    public $taxaConversao;
    public $taxaPagamento;
    public $valorMoedaDestino;
    public $dataCotacao;
    public $valorConversao;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $cotacao)
    {
        $this->nome             = auth()->user()->name;
        $this->valorConversao   = $cotacao['valor_conversao'];
        $this->moedaDestino     = $cotacao['moeda_destino'];
        $this->valorComprado    = $cotacao['valor_comprado'];
        $this->totalDescontato  = $cotacao['total_descontato'];
        $this->taxaConversao    = $cotacao['taxa_conversao'];
        $this->taxaPagamento    = $cotacao['taxa_pagamento'];
        $this->valorMoedaDestino = $cotacao['valor_moeda_destino'];
        $this->dataCotacao      = date('d/m/Y');
        $this->email               = $cotacao['to'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.email-usuario')
        //->to($this->to, $this->nome)
        ->subject('Conversão de Valores');
    }
}
