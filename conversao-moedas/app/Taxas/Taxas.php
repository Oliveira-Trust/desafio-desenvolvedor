<?php

namespace App\Taxas;

class Taxas
{
    private $formaPagamento;
    private $valorConversao;
    private $listaFormasPagamento = [
        'B' => [
            'percentualTaxa' => 1.45,
            'descricao'      => 'Boleto',
        ],
        'C' => [
            'percentualTaxa' => 7.63,
            'descricao'      => 'Cartão de Crédito',
        ],
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
