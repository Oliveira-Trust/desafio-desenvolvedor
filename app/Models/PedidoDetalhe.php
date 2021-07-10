<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalhe extends Model
{
    use HasFactory;

    protected $fillable = ['valor', 'produtos_id', 'pedidos_id'];

    public function pedido()
    {
        return $this->belongsTo('App\Pedido');
    } 


}
