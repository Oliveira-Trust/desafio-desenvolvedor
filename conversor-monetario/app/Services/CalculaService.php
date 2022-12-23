<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CalculaService
{   
    const TAXA_CARTAO = 0.0763;
    const TAXA_BOLETO = 0.0145;
    const MIN_MAX_VALOR = 3000;

    protected $taxas = [
        'boleto' => self::TAXA_BOLETO,
        'cartao' => self::TAXA_CARTAO
    ];
     
    public function calculaTaxa(float $cotacao, float $valor, string $tipoPagamento) : array
    {
        try{
            $taxaPagamento = $this->taxas[$tipoPagamento];
        
            $taxaPagamento *= $valor;
            
            switch($valor){
                case $valor < self::MIN_MAX_VALOR;
                    $taxaConversao = ($valor * 0.02);
                break;

                case $valor >= self::MIN_MAX_VALOR;
                    $taxaConversao = ($valor * 0.01);
                break;
            }
            
            $valor = ($valor - $taxaConversao - $taxaPagamento);
            $valorUtilizado = $valor;
            $valorComprado = ($valor * $cotacao);

            return [
                $valorComprado,
                $taxaPagamento,
                $taxaConversao,
                $valorUtilizado
            ]; 
        } catch(Exception $e){
            Log::info("Erro no cálculo das taxa!", ['Exception' => $e->getMessage()]);
            abort(500);
        }
    }
}