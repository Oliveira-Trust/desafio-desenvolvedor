<?php

namespace App\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Historico extends Model
{
    use HasFactory;

    protected $table = "historico";

    protected $fillable = [
        'user_id',
        'moeda_origem_id',
        'moeda_destino_id',
        'forma_id',
        'percent_taxa_pagamento',
        'percent_taxa_conversao',
        'valor_conversao',
        'valor_taxa_pagamento',
        'valor_taxa_conversao',
        'valor_moeda_destino',
        'valor_comprado'
    ];

    public function moeda_origem() {
        return $this->hasOne(Moeda::class, 'id');
    }

    public function moeda_destino() {
        return $this->hasOne(Moeda::class, 'id');
    }

    public function forma() {
        return $this->hasOne(Forma::class, 'id');
    }

    public function getList() {
        $fields = ['mo.descricao as origem_descricao',
        'mo.sigla as origem_sigla',
        'md.descricao as destino_descricao',
        'md.sigla as destino_sigla',
        'f.descricao as forma_descricao',
        'h.*'];

        $list =  DB::table('historico as h')
                    ->join('moedas as mo', 'mo.id', '=', 'h.moeda_origem_id')
                    ->join('moedas as md', 'md.id', '=', 'h.moeda_destino_id')
                    ->join('formas as f', 'f.id', '=', 'h.forma_id')
                    ->select($fields)
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('h.id')
                    ->paginate(15);

        return $list;
    }

    public function getDetail($id) {
        $fields = ['mo.descricao as origem_descricao',
        'mo.sigla as origem_sigla',
        'md.descricao as destino_descricao',
        'md.sigla as destino_sigla',
        'f.descricao as forma_descricao',
        DB::raw('(h.valor_conversao - h.valor_taxa_pagamento - h.valor_taxa_conversao) as valor_descontado'),
        'h.*'];

        $list =  DB::table('historico as h')
                    ->join('moedas as mo', 'mo.id', '=', 'h.moeda_origem_id')
                    ->join('moedas as md', 'md.id', '=', 'h.moeda_destino_id')
                    ->join('formas as f', 'f.id', '=', 'h.forma_id')
                    ->select($fields, false)
                    ->where('h.id', $id)->first();

        return $list;
    }
}
