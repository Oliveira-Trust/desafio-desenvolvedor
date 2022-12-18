<?php

namespace App\Services;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CalculaService
{   
    const TAXA_CARTAO = 0.0763;
    const TAXA_BOLETO = 0.0145;
    const MIN_MAX_VALOR = 3000;

    protected $taxas = [
        'boleto' => self::TAXA_CARTAO,
        'cartao' => self::TAXA_BOLETO
    ];
     
    public function calculaTaxa($cotacao, $valor, $tipoPagamento){
        $taxaPagamento = array_search($tipoPagamento, $this->taxas);
        $taxaPagamento *= $valor;

        switch($valor){
            case $valor < self::MIN_MAX_VALOR;
                $taxaConversao = ($valor * 0.02);
            break;

            case $valor >= self::MIN_MAX_VALOR;
                $taxaConversao = ($valor * 0.01);
            break;
        }

        $valor -= ($taxaConversao - $taxaPagamento);
        return $valor * $cotacao;
    }
}