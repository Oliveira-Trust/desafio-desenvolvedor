<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    protected $table = 'historico';
    public $timestamps = false;
    protected $fillable = ['user_id','moeda_origem','moeda_destino','valor','pagamento_tipo','valor_moeda',
        'valor_conversao','valor_convertido','moeda_comprada','taxa_pagamento','taxa_conversao','taxa_total'];


}
