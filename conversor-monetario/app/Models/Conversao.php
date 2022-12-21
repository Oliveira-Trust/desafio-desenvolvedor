<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversao extends Model
{
    use HasFactory;
    protected $table = 'conversoes';
    protected $moedadaOrigem;
    protected $moedaDestino;
    protected $valorConversao;
    protected $formaPagamento;
    protected $valorMoedaDestino;
    protected $valorComprado;
    protected $taxaPagamento;
    protected $taxaConversao;
    protected $valorUtilizado;
}
