<?php

namespace App\Models;

use App\Mail\SendEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function getDisconto()
    {
        return $this->valor - $this->taxa_conversao - $this->taxa_pagamento;
    }

    public static function getPagamentoTaxa($valor, $meio_pagamento_id)
    {
        $pagamento_taxa = MeiosPagamento::find($meio_pagamento_id);

        return ($pagamento_taxa->taxa / 100) * $valor;
    }

    public static function getPrecoCompra($valor, $preco)
    {
        return $valor / $preco;
    }
}
