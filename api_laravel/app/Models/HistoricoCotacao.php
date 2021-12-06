<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoCotacao extends Model
{
    use HasFactory;

    protected $table = 'historico';

    protected $fillable = [
        'user_id',
        'taxa_conversao', 
        'taxa_pagamento', 
        'moeda_destino', 
        'moedas_comprada',
        'total_conversao',
        'moeda'
    ];

    public function user() 
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }


}
