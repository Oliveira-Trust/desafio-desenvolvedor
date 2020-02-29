<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class clientes extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'telefone',
        'celular',
        'sexo',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'logradouro',
        'numero'
    ];

}
