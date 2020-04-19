<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = ['cliente_id', 'status_id', 'total'];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function status() {
        return $this->belongsTo('App\Models\Status');
    }

    public function itens() {
        return $this->hasMany('App\Models\ItemPedido');
    }
}
