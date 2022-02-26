<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotacaoPreco extends Model
{
    use HasFactory;

    protected $table = "cotacao_preco";
    protected $fillable = [
        'user_id',
        'meio_pagamento_id',
        'origem_moeda',
        'destino_meda',
        'valor',
        'valor_moeda',
        'preco_compra',
        'taxa_pagamento',
        'taxa_conversao'
    ];

    public function meioPagamento(): BelongsTo
    {
        return $this->belongsTo(MeiosPagamento::class);
    }

    public function getDisconto(): float
    {
        return $this->valor - $this->taxa_conversao - $this->taxa_pagamento;
    }
}
