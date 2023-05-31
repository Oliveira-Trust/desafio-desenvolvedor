<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxaFormaPagamento extends Model
{
    protected $fillable = [
        'tipo_forma_pagamento', 'taxa', 'descricao'
    ];

    //Calcula a TaxaFormaPagamento recebendo o valor já acrescido a taxa de conversão
    //retorna variável $valorAcrescido
    public function calcularTaxaFormaPagamento($valor)
    {
        $valorAcrescido = $valor + ($valor / 100 * $this->taxa);
        return $valorAcrescido;
    }
}
