<?php

namespace App\Models\Cotacao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tipo\TipoCobranca;

class CotacaoTaxa extends Model
{
    use HasFactory;
    protected $table = 'cotacoes_taxas';
    protected $primaryKey = 'id';
    protected $fillable = [
        //'cotacao_taxa_id',
        'tipo_cobranca_id',
        'dsc_cotacao_taxa',
        'per_cotacao_taxa',
        'ind_status'
    ];

    public function tipoCobranca(){
        return $this->belongsTo(TipoCobranca::class, 'tipo_cobranca_id', 'id');
    }

    public function cotacaoTaxaRange(){
        return $this->hasOne(CotacaoTaxaRange::class, 'cotacao_taxa_id', 'id');
    }
}
