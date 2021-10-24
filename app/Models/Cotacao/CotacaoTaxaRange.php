<?php

namespace App\Models\Cotacao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotacaoTaxaRange extends Model
{
    use HasFactory;
    //cotacao_taxa_id => pk
    protected $table = "cotacoes_taxas_ranges";
    protected $fillable = [
        'cotacao_taxa_id',
        'val_minimo',
        'val_maximo',
        'ind_status'
    ];

    public function cotacao(){
        return $this->hasOne(CotacaoTaxa::class, 'id', 'cotacao_taxa_id');
    }
}
