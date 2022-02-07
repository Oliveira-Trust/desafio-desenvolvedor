<?php

namespace App\Helpers;

use App\Models\Taxa;

class ConversaoHelper
{
    private const TAXA_CARTAO = 1.45;
    private const TAXA_BOLETO = 7.63;

    private const TAXA_ABAIXO = 2;
    private const TAXA_ACIMA = 1;

    public static function getTaxasFormaPagamento($formaPagamento, $valorPagamento)
    {
        $resultado = 0.0;
        switch ($formaPagamento) {
            case 'boleto':
                $resultado = ($valorPagamento * self::TAXA_BOLETO) / 100;
                break;
            case 'cartao':
                $resultado = ($valorPagamento * self::TAXA_CARTAO) / 100;
                break;
        }
        return $resultado;
    }

    public static function aplicarTaxaConversao($valor)
    {
        $resultado = 0.0;
        if ($valor < 3000) {
            $resultado = ($valor * self::TAXA_ABAIXO) / 100;
        } else {
            $resultado = ($valor * self::TAXA_ACIMA) / 100;
        }
        return $resultado;
    }
}
