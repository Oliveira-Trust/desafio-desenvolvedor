<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'moeda_origem',
        'moeda_destino',
        'valor_conversao',
        'forma_pagamento',
        'valor_moeda_destino',
        'valor_comprado',
        'taxa_pagamento',
        'taxa_conversao',
        'total_descontato',
    ];
}
