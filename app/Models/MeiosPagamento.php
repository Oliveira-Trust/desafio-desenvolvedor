<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeiosPagamento extends Model
{
    use HasFactory;

    protected $table = "meios_pagamento";
    protected $fillable = [
        'meio_pagamento',
        'taxa'
    ];

    public function getMeiosPagamento()
    {
        $meios = [
            'cartao' => 'Cartão de crédito',
            'boleto' => 'Boleto',
        ];

        return $meios[$this->meio];
    }
}
