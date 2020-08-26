<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produto;

class ProdutosController extends Controller
{
	
	// CREATE ----------------------------------------------
    public function criar()
	{
		return view('produtos.criar');
	}
	
	public function criar_produto(Request $request)
	{
		$resposta = Produto::validaDadosProduto ($request->nome, $request->descricao, $request->preco);
		
		if ($resposta == null) {
			Produto::create([
				"nome" => $request->nome,
				"descricao" => $request->descricao,
				"preco" => $request->preco
			]);
			
			$resposta = response()->json([
				'status' => 'success',
				'mensagem' => 'Produto criado com sucesso.'
			]);
		}
		
		return $resposta;

	}
	
	
	// READ ----------------------------------------------
	public function ver($id)
	{
		$produto = Produto::findOrFail($id);
		return view('produtos.ver', [ 'produto' => $produto ]);
	}
	
	public function listar()
	{
		$produtos = Produto::all();
		return view('produtos.listar', [ 'produtos' => $produtos ]);
	}
	
	
	// UPDATE ----------------------------------------------
    public function alterar($id)
	{
		$produto = Produto::findOrFail($id);
		return view('produtos.alterar', [ 'produto' => $produto ]);
	}
	
	public function alterar_produto(Request $request, $id)
	{	
		$resposta = Produto::validaDadosProduto ($request->nome, $request->descricao, $request->preco);
		
		if ($resposta == null) {
			$produto = Produto::findOrFail($id);
			$produto->update([
				"nome" => $request->nome,
				"descricao" => $request->descricao,
				"preco" => $request->preco
			]);
			
			return response()->json([
				'status' => 'success',
				'mensagem' => 'Produto atualizado com sucesso.'
			]);
		}
		
		return $resposta;
		
	}
	
	
	// DELETE ----------------------------------------------
    public function remover($id)
	{
		$produto = Produto::findOrFail($id);
		
		return view('produtos.remover', [ 'produto' => $produto ]);
	}
	
	public function remover_produto(Request $request, $id)
	{
		$produto = Produto::findOrFail($id);
		
		// Verifica se o produto não está associado a nenhum pedido:
		if ($produto->pedidos()->count() == 0) {
			$produto->delete();
			return response()->json([
				'status' => 'success',
				'mensagem' => 'Produto removido com sucesso. Retornando à listagem.'
			]);
		} else {
			return response()->json([
				'status' => 'warning',
				'mensagem' => 'Não foi possível remover o produto pois há pelo menos um pedido associado. Retornando à listagem.'
			]);
		}
	}
	
	public function remover_produtos(Request $request)
	{
		$ids = explode (',' , $request->ids);
		
		$naoExcluidos = 0;
		$excluidos = 0;
		foreach($ids as $id) {
			$produto = Produto::findOrFail($id);
			
			// Verifica se o produto não estã associado a nenhum pedido:
			if ($produto->pedidos()->count() == 0) {
				$produto->delete();
				$excluidos += 1;
			} else {
				$naoExcluidos += 1;
			}
		}
		
		return response()->json([
			'status' => 'success',
			'mensagem' => "$excluidos produtos excluídos. $naoExcluidos associados à pedidos. Recarregando a página." 
		]);
		
	}
	
	
}
