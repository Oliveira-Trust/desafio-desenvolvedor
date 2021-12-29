<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moeda extends Model
{
    public function metodoEscolhido($formaPagamento)
    {
        if ($formaPagamento == 0) {
            $forma = "Boleto";
        } elseif ($formaPagamento == 1) {
            $forma = "Cartão de Crédito";
        }
        return $forma;
    }

    public function taxaPagamento($formaPagamento, $valorEmReal)
    {
        if ($formaPagamento == 0) {
            $taxaPagamento = $valorEmReal * 1.45 / 100;
        } elseif ($formaPagamento == 1) {
            $taxaPagamento = $valorEmReal * 7.63 / 100;
        }
        return $taxaPagamento;
    }

    public function taxaConversao($valorEmReal)
    {
        if ($valorEmReal < 3000) {
            $taxaConversao = $valorEmReal * 2.0 / 100;
        } else {
            $taxaConversao = $valorEmReal * 1.0 / 100;
        }

        return $taxaConversao;
    }

}
