<?php

namespace App\Domain\Converter\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transacoes';

    protected $fillable = [
        'public_id',
        'valor',
        'moeda_origem',
        'moeda_destino',
        'taxa_cambio',
        'taxa_pagamento',
        'taxa_conversao',
        'taxas_totais',
        'valor_final',
        'valor_convertido',
        'forma_pagamento',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
