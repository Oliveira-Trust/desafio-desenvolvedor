<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TaxaPagamento extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'taxa_modalidade_pgto';
    protected $fillable = [
        'tipo_pagamento',
        'taxa'
    ];
}
