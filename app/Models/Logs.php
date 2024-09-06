<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id', 'moeda_origem', 'valor_entrada', 'moeda_destino', 'valor_saida', 'forma_pagamento'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
