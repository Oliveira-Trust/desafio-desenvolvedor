<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;

class ClientesController extends Controller
{
	
	// CREATE ----------------------------------------------
    public function criar()
	{
		return view('clientes.criar');
	}
	
	public function criar_cliente(Request $request)
	{
		$resposta = Cliente::validaDadosClienteCadastro ($request->login, $request->email, $request->cpf);
		
		if ($resposta == null) {
			
			Cliente::create([
				"login" => $request->login,
				"senha" => Cliente::criarSenha($request->senha),
				"nome" => $request->nome,
				"cpf" => $request->cpf,
				"tel" => $request->tel,
				"email" => $request->email
			]);
			
			$resposta = response()->json([
				'status' => 'success',
				'mensagem' => 'Cliente criado com sucesso.'
			]);
		} 
		
		return $resposta;

	}
	
	
	// READ ----------------------------------------------
	public function ver($id)
	{
		$cliente = Cliente::findOrFail($id);
		return view('clientes.ver', [ 'cliente' => $cliente ]);
	}

	public function listar()
	{
		$clientes = Cliente::all();
		return view('clientes.listar', [ 'clientes' => $clientes ]);
	}
	
	
	// UPDATE ----------------------------------------------
    public function alterar($id)
	{
		$cliente = Cliente::findOrFail($id);
		return view('clientes.alterar', [ 'cliente' => $cliente ]);
	}

	public function alterar_cliente(Request $request, $id)
	{
		$cliente = Cliente::findOrFail($id);
		$resposta = Cliente::validaDadosClienteAlteracao ($cliente, $request->login, $request->email, $request->cpf);
		
		if ($resposta == null) {

			$cliente->update([
				"login" => $request->login,
				"senha" => Cliente::criarSenha($request->senha), 
				"nome" => $request->nome,
				"cpf" => $request->cpf,
				"tel" => $request->tel,
				"email" => $request->email
			]);
			
			$resposta = response()->json([
				'status' => 'success',
				'mensagem' => 'Cliente atualizado com sucesso. Recarregando a página.'
			]);
		}
		
		return $resposta;
	}
	
	
	// DELETE ----------------------------------------------
    public function remover($id)
	{
		$cliente = Cliente::findOrFail($id);
		
		return view('clientes.remover', [ 'cliente' => $cliente ]);
	}
	
	public function remover_cliente(Request $request, $id)
	{
		$cliente = Cliente::findOrFail($id);
		$cliente->removerPedidos();
		$cliente->delete();
		
		return response()->json([
			'status' => 'success',
			'mensagem' => 'Cliente removido com sucesso. Retornando à listagem.'
		]);
		
	}
	
	public function remover_clientes(Request $request)
	{
		$ids = explode (',' , $request->ids);
		
		foreach($ids as $id) {
			$cliente = Cliente::findOrFail($id);
			$cliente->removerPedidos();
			$cliente->delete();
		}
		
		return response()->json([
			'status' => 'success',
			'mensagem' => "Cliente(s) removido(s) com sucesso. Recarregando a página."
		]);
		
	}
	
	
	
}
