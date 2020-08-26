<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pedido;
use App\Cliente;
use App\Produto;

use DateTime;
use DateTimeZone;

class PedidosController extends Controller
{
	
	// CREATE ----------------------------------------------
    public function criar()
	{
		$clientes = Cliente::all();
		$produtos = Produto::select('id', 'nome', 'preco')->get();
		return view('pedidos.criar', [ 'clientes' => $clientes, 'produtos' => $produtos ] );
	}
	
	public function criar_pedido(Request $request)
	{
		$produtos = json_decode($request->produtos);
		
		for ($i = count($produtos) - 1; $i >= 0; $i--) {
			// Remove se a quantidade for negativa ou nula.
			if ($produtos[$i]->quant <= 0) {
				unset($produtos[$i]);
			}
		}
		
		if (count($produtos) > 0) {
			
			$hoje = date('Y-m-d H:i:s'); // Em formato DATETIME para o MySQL.
			$pedido = Pedido::create([
				"status" => $request->status,
				"cliente_id" => $request->cliente_id,
				"data_criacao" => $hoje,
				"data_atualizacao" => $hoje
			]);
		
			foreach ($produtos as $produto) {
				$pedido->produtos()->attach( $produto->id, [ 'produto_quant' => $produto->quant ] );
			}
			
			return response()->json([
				'status' => 'success',
				'mensagem' => 'Pedido criado com sucesso. Recarregando a página.'
			]);
		} else {
			return response()->json([
				'status' => 'warning',
				'mensagem' => 'Não é possível criar um pedido sem produtos válidos.'
			]);
		}
		
	}
	
	
	// READ ----------------------------------------------
	public function ver($id)
	{
		$pedido = Pedido::findOrFail($id);
		
		$diff_GMT = '-3 hours'; // Brasil é GMT - 3.
		
		// Formata datas de criação e atualização do pedido.
		$data_criacao = DateTime::createFromFormat (
			'Y-m-d H:i:s' , 
			$pedido->data_criacao
		)->modify($diff_GMT);
		$data_criacao_str = $data_criacao->format('d/m/Y H:i:s');
		
		$data_atualizacao = DateTime::createFromFormat (
			'Y-m-d H:i:s' , 
			$pedido->data_atualizacao
		)->modify($diff_GMT);
		$data_atualizacao_str = $data_atualizacao->format('d/m/Y H:i:s');
		
		// Calcula preço total do pedido.
		$total = 0;
		foreach ($pedido->produtos as $produto) {
			$total += $produto->preco * $produto->pedido_produtos->produto_quant;
		}
		$pedido->total = $total;
		
		return view('pedidos.ver', [ 
			'pedido' => $pedido, 
			'data_criacao_str' => $data_criacao_str,
			'data_atualizacao_str' => $data_atualizacao_str
		]);
	}
	
	public function listar()
	{
		$pedidos = Pedido::all();
		
		$diff_GMT = '-3 hours'; // Brasil é GMT - 3.
		
		foreach ($pedidos as $pedido) {
			// Formata datas de criação e atualização do pedido.
			$data_criacao = DateTime::createFromFormat (
				'Y-m-d H:i:s' , 
				$pedido->data_criacao
			)->modify($diff_GMT);
			$pedido->data_criacao_str = $data_criacao->format('Y-m-d H:i:s');
			
			$data_atualizacao = DateTime::createFromFormat (
				'Y-m-d H:i:s' , 
				$pedido->data_atualizacao
			)->modify($diff_GMT);
			$pedido->data_atualizacao_str = $data_atualizacao->format('Y-m-d H:i:s');
			
			// Calcula preço total do pedido.
			$total = 0;
			foreach ($pedido->produtos as $produto) {
				$total += $produto->preco * $produto->pedido_produtos->produto_quant;
			}
			$pedido->total = $total;
		}
		
		return view('pedidos.listar', [ 'pedidos' => $pedidos ]);
	}
	
	
	// UPDATE ----------------------------------------------
    public function alterar($id)
	{
		$pedido = Pedido::findOrFail($id);
		$clientes = Cliente::all();
		$produtos = Produto::select('id', 'nome', 'preco')->get();
		
		// Calcula preço total do pedido.
		$total = 0;
		foreach ($pedido->produtos as $produto) {
			$total += $produto->preco * $produto->pedido_produtos->produto_quant;
		}
		$pedido->total = $total;
		return view('pedidos.alterar', [ 
			'pedido' => $pedido, 
			'clientes' => $clientes, 
			'produtos' => $produtos 
		]);
	}
	
	public function alterar_pedido(Request $request, $id)
	{
		$produtos = json_decode($request->produtos);
	
		for ($i = count($produtos) - 1; $i >= 0; $i--) {
			// Remove se a quantidade for negativa ou nula.
			if ($produtos[$i]->quant <= 0) {
				unset($produtos[$i]);
			}
		}
	
		if (count($produtos) > 0) {
			$pedido = Pedido::findOrFail($id);
			
			$hoje = date('Y-m-d H:i:s'); // Em formato DATETIME para o MySQL.
			$pedido->update([
				"status" => $request->status,
				"cliente_id" => $request->cliente_id,
				"data_atualizacao" => $hoje
			]);

			// Remove todos os produtos:
			$pedido->produtos()->detach();
			
			// Adiciona novamente (apenas os que estão na view):
			foreach ($produtos as $produto) {
				$pedido->produtos()->attach( $produto->id, [ 'produto_quant' => $produto->quant ] );
			}
			
			return response()->json([
				'status' => 'success',
				'mensagem' => 'Pedido atualizado com sucesso. Recarregando a página.'
			]);
			
		} else {
			return response()->json([
				'status' => 'error',
				'mensagem' => 'O pedido precisa ter pelo menos um produto válido.'
			]);
		}
	}
	
	
	// DELETE ----------------------------------------------
    public function remover($id)
	{
		$pedido = Pedido::findOrFail($id);
		return view('pedidos.remover', [ 'pedido' => $pedido ]);
	}
	
	public function remover_pedido(Request $request, $id)
	{
		$pedido = Pedido::findOrFail($id);
		
		// Remove todos os produtos:
		$pedido->produtos()->detach();
		
		$pedido->delete();
		
		return response()->json([
			'status' => 'success',
			'mensagem' => 'Pedido removido com sucesso. Retornando à listagem.'
		]);
		
	}
	
	public function remover_pedidos(Request $request)
	{
		$ids = explode (',' , $request->ids);
		
		foreach($ids as $id) {
			$pedido = Pedido::findOrFail($id);
			
			// Remove todos os produtos:
			$pedido->produtos()->detach();
			
			$pedido->delete();
		}
		
		return response()->json([
			'status' => 'success',
			'mensagem' => "Pedido(s) removido(s) com sucesso. Recarregando a página."
		]);
		
	}
	
	
}
