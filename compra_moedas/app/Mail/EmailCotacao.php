<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailCotacao extends Mailable
{
    use Queueable, SerializesModels;


   protected $id_cotacao;
   protected $moedaOrigem;
   protected $moedaDestino;
   protected $valorConversao;
   protected $formaPgto;
   protected $valorMoedaDestino;
   protected $valorComprado;
   protected $taxaPagamento;
   protected $taxaConversao;
   protected $valorTotalUsado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_cotacao, $moedaOrigem,$moedaDestino,$valorConversao,$formaPgto,$valorMoedaDestino,$valorComprado,$taxaPagamento,$taxaConversao,$valorTotalUsado)
    {
        $this->id_cotacao = $id_cotacao;
        $this->moedaOrigem = $moedaOrigem;
        $this->moedaDestino = $moedaDestino;
        $this->valorConversao = $valorConversao;
        $this->formaPgto = $formaPgto;
        $this->valorMoedaDestino = $valorMoedaDestino;
        $this->valorComprado = $valorComprado;
        $this->taxaPagamento = $taxaPagamento;
        $this->taxaConversao = $taxaConversao;
        $this->valorTotalUsado = $valorTotalUsado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.cotacao')->with([
            "id_cotacao"=> $this->id_cotacao,
            "moedaOrigem"=> $this->moedaOrigem,
            "moedaDestino"=> $this->moedaDestino,
            "valorConversao"=> $this->valorConversao,
            "formaPgto"=> $this->formaPgto,
            "valorMoedaDestino"=> $this->valorMoedaDestino,
            "valorComprado"=> $this->valorComprado,
            "taxaPagamento"=> $this->taxaPagamento,
            "taxaConversao"=> $this->taxaConversao,
            "valorTotalUsado"=> $this->valorTotalUsado,
        ]);
    }
}
