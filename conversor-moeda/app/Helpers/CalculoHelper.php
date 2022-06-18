<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class CalculoHelper
{

    ## Os nomes das funções são auto explicativos
    ## São funções auxiliares e em um sistema 'maior', algumas ficaraiam em arquivos genericos onde serviriam à todos os helpers e controllers

    public function __construct()
    {
        $this->TAXA_CONVERSAO_MAIOR_3_MIL = 1;
        $this->TAXA_CONVERSAO_MENOR_3_MIL = 2;
        $this->TAXA_PAGAMENTO_BOLETO = 1.45;
        $this->TAXA_PAGAMENTO_CARTAO = 7.63;
    }

    public function taxa_conversao($valor_real)
    {
        switch ($valor_real) {
            case $valor_real > 3000:
                return $this->TAXA_CONVERSAO_MAIOR_3_MIL;
                break;
            case $valor_real < 3000:
                return $this->TAXA_CONVERSAO_MENOR_3_MIL;
                break;
            default:
                return 0;
                break;
        }
    }

    public function forma_pgto($forma_pgto)
    {
        switch ($forma_pgto) {
            case 'CARTAO':
                return $this->TAXA_PAGAMENTO_CARTAO;
                break;
            case 'BOLETO':
                return $this->TAXA_PAGAMENTO_BOLETO;
                break;
            default:
                return 0;
                break;
        }
    }
    public static function consultaAPI($rota)
    {
        $ret = new \stdClass;
        $ret->error = false;
        try {
            $response = Http::get($rota);
            return $ret->msg = $response;
        } catch (\Throwable $th) {
            $ret->error = true;
            return $ret->msg = $th->getMessage();;
        }
    }

    public static function validacao_valores($valor_real)
    {
        $valor_real = floatval($valor_real);
        try {
            $ret = new \stdClass;
            switch ($valor_real) {
                case $valor_real < 1000:
                    $ret->error = 'error';
                    $ret->msg = "Valor deve ser maior que 1 mil reais";
                    break;
                case $valor_real > 100000:
                    $ret->error = 'warning';
                    $ret->msg = "Valor deve ser menor que 100 mil reais";
                    break;
                default:
                    $ret->error = false;
                    $ret->msg = "";
                    break;
            }
            return $ret;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public static function limpar_valor($valor_real)
    {
        $valor_real = str_replace(',', ' ', $valor_real);
        $valor_real = str_replace('.', '', $valor_real);
        $valor_real = str_replace(' ', '.', $valor_real);
        return $valor_real;
    }
}
