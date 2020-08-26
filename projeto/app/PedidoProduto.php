<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/* 
 *	Tabela própria (n x m) entre Produto e Pedido.
 *	Propriedades são definidas em Pedido e Produto.
*/
class PedidoProduto extends Pivot
{
	protected $fillable = ['pedido_id', 'produto_id', 'produto_quant'];
    protected $guarded = ['id'];
    protected $table = 'pedido_produtos';
	
	public $timestamps = false; // Eloquent não deve gerenciar created_at ou updated_at.
    public $incrementing = true; // Possui id AUTO INCREMENT.
	
}
