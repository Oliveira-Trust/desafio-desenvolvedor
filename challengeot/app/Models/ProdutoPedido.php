<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoPedido extends Model
{
    protected $table        = 'tb_produtos_pedido';
    protected $fillable     = ['pedido_id', 'produto_id', 'quantidade'];
    protected $primaryKey   = 'id';
}
