<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    use HasFactory;

    protected $table = 'cotacoes';

    protected $fillable = [
        'moeda_origem', 'moeda_destino', 'valor_conversao', 'forma_pagamento', 'valor_moeda_destino',
        'valor_comprado_moeda_destino', 'taxa_pagamento', 'taxa_conversao', 'valor_conversao_com_taxas'
    ];
}
