<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryCurrencyConversion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'moeda_origin',
        'moeda_destino',
        'forma_pagamento',
        'taxa_pagamento',
        'taxa_conversao',
        'valor_conversao',
        'valor_com_taxa',
        'valor_sem_taxa',
        'user_id'
    ];

    protected $table = 'history_currency_conversion';
}
