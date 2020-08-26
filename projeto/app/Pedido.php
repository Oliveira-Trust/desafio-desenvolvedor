<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
	public $timestamps = false; // Eloquent não deve gerenciar created_at ou updated_at.
	
    protected $fillable = ['status', 'cliente_id', 'data_criacao', 'data_atualizacao'];
    protected $guarded = ['id'];
    protected $table = 'pedidos';
	
	// Cliente ao qual pertence o pedido.
	public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
	
	public function produtos()
    {
        return $this->belongsToMany('App\Produto', 'pedido_produtos')
					->as('pedido_produtos') // Nome para acesso no programa.
					->using('App\PedidoProduto')
					->withPivot('produto_quant'); // Colunas que não são FOREIGN KEY.
    }
	
}
