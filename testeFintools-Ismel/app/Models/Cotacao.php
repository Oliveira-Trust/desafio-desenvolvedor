<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'moeda_origem',
        'moeda_destino',
        'valor_conversao',
        'forma_pagamento',
        'valor_usado_conversao',
        'valor_comprado',
        'taxa_pagamento',
        'taxa_conversao', 
        'data_transacao',
        'user_id',
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

}
