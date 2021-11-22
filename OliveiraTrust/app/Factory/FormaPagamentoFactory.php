<?php

namespace App\Factory;

use App\Services\Boleto;
use App\Services\Cartao;
use App\Interfaces\FormaPagamentoInterface;

class FormaPagamentoFactory {

    public function formaPagamento($interface){

        if($interface == "cartao") {
            return new Cartao;
        }
        return new Boleto;
    }
}
