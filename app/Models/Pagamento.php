<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tipo_pagamento',
        'valor_taxa',
        'created_at',
        'updated_at',
    ];

    public static function getTipoPagamentoByID($tipo)
    {
        return DB::table('metodos_de_pagamento')->find($tipo);
    }
}
