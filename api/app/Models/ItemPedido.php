<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $table = 'item_pedidos';

    protected $fillable = ['pedido_id', 'produto_id', 'quantidade', 'preco'];

    public function pedido() {
        return $this->belongsTo('App\Models\Pedido');
    }

    public function produto() {
        return $this->belongsTo('App\Models\Produto');
    }
}
