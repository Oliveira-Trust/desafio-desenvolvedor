<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
	public $timestamps = false; // Eloquent não deve gerenciar created_at ou updated_at.
	
    protected $fillable = ['nome', 'descricao', 'preco'];
    protected $guarded = ['id'];
    protected $table = 'produtos';
	
	public function pedidos()
    {
        return $this->belongsToMany('App\Pedido', 'pedido_produtos')
					->as('pedido_produtos') // Nome para acesso no programa.
					->using('App\PedidoProduto')
					->withPivot('produto_quant'); // Colunas que não são FOREIGN KEY.
    }
	
	
	/*
		Valida alguns dados antes de criar ou alterar o produto.
		Retorna null se não houver problema ou um JSON com resposta 
		sobre o problema encontrado.
	*/
	public static function validaDadosProduto ($nome, $descricao, $preco) 
	{
		$resposta = null;
		
		if ($nome == null || $nome == "") {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'Nome inválido.'
			]);
		} else if ($descricao == null || $descricao == "") {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'Nome inválido.'
			]);
		} else if ($preco == null || $preco == "" || floatval($preco) <= 0) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'Preço inválido.'
			]);
		}
		
		return $resposta;
	}
	
}
