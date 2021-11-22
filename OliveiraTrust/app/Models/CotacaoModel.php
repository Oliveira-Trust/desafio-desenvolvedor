<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CotacaoModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cotacao';
    protected $fillable = ['id', 'moeda_origem', 'moeda_destino', 'taxa_conversao', 'taxa_forma_pagamento',
    'valor_liquido', 'valor_bruto', 'id_user', 'created_at', 'updated_at', 'deleted_at'];
}
