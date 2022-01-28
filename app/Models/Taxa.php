<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    protected $table = 'taxas';

    protected $fillable = [
        'enumTipoTaxa',
        'idTipoPagamento',
        'flTaxa',
        'flValorMinTaxa',
        'flValorMaxTaxa'
    ];

    public function tipopagamentos(){

        return $this->belongsTo(TipoPagamento::class,'idTipoPagamento','id');

    }
    
}
