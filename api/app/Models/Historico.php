<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historico extends Model
{
    use SoftDeletes;

    /**
     * Atributos de Historico editaveis
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'data_cotacao', 'valorEntrada', 'moeda_origem', 'moeda_destino', 'formaPagamento', 'valor_moeda_destino', 'taxaConversao','taxaPagameno','valorPagamento','valorMoedaDestino','statusCotacao'
    ];

    /**
     * Atributos Ocultos
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function usuario()
    {
        return $this->hasOne(Usuarios::class, 'id', 'usuario_id');
    }
}
