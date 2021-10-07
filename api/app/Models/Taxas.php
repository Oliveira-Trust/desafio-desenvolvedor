<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxas extends Model
{
    use SoftDeletes;
    /**
     * Atributos de Moedas editaveis
     *
     * @var array
     */
    protected $fillable = [
        'moeda_id', 'taxaConversaoMin', 'taxaConversaoMax', 'taxaCartao', 'taxaBoleto', 'valor_controle'
    ];

    /**
     * Atributos Ocultos
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
}
