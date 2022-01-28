<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagamento extends Model
{

    protected $table = 'tipo_pagamentos';

    protected $fillable = [
        'strTipoPagamento',
        'strDescricao'
    ];

    public function taxas(){
        
        return $this->hasOne(Taxa::class,'idTipoPagamento','id');

    }
}
