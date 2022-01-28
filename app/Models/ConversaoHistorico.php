<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversaoHistorico extends Model
{
    protected $table = 'conversao_historico';

    protected $fillable = [
        'idUsuario',
        'strMoedaOrigem',
        'strMoedaDestino',
        'flValorConversao',
        'strFormaPagamento',
        'flValorMoedaDestinoConversao',
        'flValorCompradoMoedaDestino',
        'flTaxaPagamento',
        'flTaxaConversao',
        'flValorUtilizadoConversao',
    ];

}
