<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoConversao extends Model
{
    use HasFactory;

    protected $table = 'historico_conversoes';

    protected $fillable = [
        'moeda_origem',
        'moeda_destino',
        'valor_para_conversao',
        'forma_pagamento',
        'bid_destino',
        'valor_comprado',
        'taxa_pagamento',
        'taxa_conversao',
        'valor_utilizado_para_conversao',
    ];
}

