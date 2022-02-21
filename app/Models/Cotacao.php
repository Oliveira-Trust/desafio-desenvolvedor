<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Cotacao extends Model
{
    protected $table = 'cotacao';

    protected $fillable = [
        'valor_conversao',
        'moeda_destino',
        'forma_pagamento',
        'user_id',
        'valor_moeda_destino',
        'valor_comprado_moeda_destino',
        'taxa_pagamento',
        'taxa_conversao',
        'valor_conversao_desconto_taxas',
    ];

    public static function find_by_user(){
        return Cotacao::where('user_id', Auth::user()->id)->get();
    }

    public function getFormaPagamentoAttribute(){
        return $this->attributes['forma_pagamento'] == 1 ? 'Boleto' : 'Cartão de Crédito';
    }

    public function getCreatedAtAttribute(){
        $createdAt = Carbon::parse($this->attributes['created_at']);
        return $createdAt = $createdAt->format('d/m/Y');
    }
}
