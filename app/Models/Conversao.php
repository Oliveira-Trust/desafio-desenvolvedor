<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversao extends Model
{
    use HasFactory;

    protected $table = 'conversoes';

    protected $casts = [
        'valor_compra' => 'float',
        'perc_taxa_pgto' => 'float',
        'taxa_pagamento' => 'float',
        'perc_taxa_conversao' => 'float',
        'taxa_conversao' => 'float',
        'saldo_conversao' => 'float',
        'valor_cotacao' => 'float',
        'valor_convertido' => 'float',
        'data' => 'datetime',
    ];
}
