<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'ativo'
    ];

    public static function busca($pesquisar)
    {
        return static::where('nome', 'LIKE', '%' . $pesquisar . '%')->get();
    }
}
