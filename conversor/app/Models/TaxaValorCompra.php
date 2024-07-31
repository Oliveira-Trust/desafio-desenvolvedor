<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TaxaValorCompra extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'taxa_valor_compra';
    protected $fillable = [
        'valor',
        'taxa_valor_menor',
        'taxa_valor_maior_igual'
    ];
}
