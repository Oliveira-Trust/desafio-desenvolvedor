<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cotacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'usuario_id',
        'moeda_original',
        'moeda_destino',
        'valor_inicial',
        'tipo_pagamento_id',
        'valor_moeda_destino',
        'valor_comprado',
        'valor_taxa_tipo_pagamento',
        'valor_taxa_conversao',
        'valor_inicial_taxado',
        'created_at',
    ];

    public static function insertData(array $data)
    {
        return DB::table('cotacoes_realizadas')->insertGetId($data);
    }


}
