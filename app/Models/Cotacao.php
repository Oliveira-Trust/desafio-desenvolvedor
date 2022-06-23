<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cotacao extends Model
{
    use HasFactory;

    protected $table = 'cotacoes_realizadas';
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

    public static function getCotacaoByUserId(int $user)
    {
        return DB::table('cotacoes_realizadas as c')
            ->leftJoin('moedas as m1','m1.id','=','c.moeda_original')
                ->leftJoin('moedas as m2', 'm2.id', '=', 'c.moeda_destino')
                    ->leftJoin('metodos_de_pagamento as p','p.id','=','c.tipo_pagamento_id' )
                        ->select('c.*','m1.abreviacao_moeda as moedaOriginal', 'm2.abreviacao_moeda as moedaDestino', 'p.tipo_pagamento')
                            ->orderBy('id', 'desc')
                                ->where('usuario_id','=', $user)->paginate(5);
    }

    public function moedaOrigem()
    {
        return $this->hasOne(Moeda::class, 'id', 'moeda_original');
    }

    public function moedaDestino()
    {
        return $this->hasOne(Moeda::class, 'id', 'moeda_destino');
    }

}
