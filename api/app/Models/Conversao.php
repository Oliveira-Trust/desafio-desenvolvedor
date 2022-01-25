<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversao extends Model
{
    use HasFactory;

    protected $table = 'conversao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'moeda_origem',
        'moeda_destino',
        'valor_conversao',
        'forma_pagamento',
        'valor_moeda_destino',
        'valor_comprado',
        'taxa_pagamento',
        'taxa_conversao',
        'valor_converter',
        'user_id'
    ];
}
