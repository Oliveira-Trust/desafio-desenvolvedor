<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table        = 'tb_pedidos';
    protected $fillable     = ['nome', 'cliente_id'];
    protected $primaryKey   = 'id';

    public function getCliente(){
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }
    public function getProdutosPed(){
        return $this->hasMany('App\Models\ProdutoPedido', 'pedido_id', 'id');
    }
}