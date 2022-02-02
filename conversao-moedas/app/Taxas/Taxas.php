<?php

namespace App\Taxas;

class Taxas
{
    private $formaPagamento;
    private $valorConversao;
    private $listaFormasPagamento = [
        'B' => 1.45,
        'C' => 7.63,
    ];

    public function __construct($formaPagamento, $valorConversao)
    {
        $this->formaPagamento = $formaPagamento;
        $this->valorConversao = $valorConversao;
    }

    public function retornaTaxaFormaPagamento()
    {
        return $this->listaFormasPagamento[$this->formaPagamento];
    }

    public function retornaTaxaValorConversao()
    {
        return $this->valorConversao < 3000 ? 2 : 1;
    }
}
