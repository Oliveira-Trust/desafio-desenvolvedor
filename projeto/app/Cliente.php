<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Pedido;

class Cliente extends Model
{
	public $timestamps = false; // Eloquent não deve gerenciar created_at ou updated_at.
	
    protected $fillable = ['login', 'senha', 'nome', 'cpf', 'tel', 'email'];
    protected $guarded = ['id'];
    protected $table = 'clientes';
	
	// Pedidos de um cliente qualquer.
	public function pedidos()
    {
        return $this->hasMany('App\Pedido');
    }
	
	/*
		Recebe senha em plaintext e transforma num hash apropriado 
		de ser salvo no banco de dados.
	*/
	public static function criarSenha($password) 
	{
		if (defined('PASSWORD_ARGON2ID')) {
			return password_hash($password, PASSWORD_ARGON2ID, array('cost'=>15));
		} else if (defined('PASSWORD_BCRYPT')) {
			return password_hash($password, PASSWORD_BCRYPT, array('cost'=>15));
		} else {
			return password_hash($password, PASSWORD_DEFAULT, array('cost'=>15));
		}
	}
	
	// Remove os pedidos associados a um cliente.
	public function removerPedidos() 
	{
		// TODO - essa parte do fluxo não está funcionando, remover os 
		// produtos associados da tabela pivot assim ou com onDelete('cascade').
		foreach ($this->pedidos() as $pedido) 
		{
			// Remove todos os produtos associados:
			$pedido = Pedido::findOrFail($pedido->id);
			$pedido->produtos()->detach();
		}
		
		$this->pedidos()->delete();
	}
	
	// Métodos de validação e query.
	public static function existeLogin($login) 
	{
		return DB::table('clientes')->where('login', $login)->exists();
	}
	
	public static function existeEmail($email) 
	{
		return DB::table('clientes')->where('email', $email)->exists();
	}
	
	public static function existeCPF($cpf) 
	{
		return DB::table('clientes')->where('cpf', $cpf)->exists();
	}
	
	/*
		Verifica se o CPF é válido. Adaptado da Receita Federal.
		Retorna true se for válido, false se não.
	*/
	public static function validaCPF($cpf) 
	{
		$soma = 0;
		
		if (strlen($cpf) != 11) {
			return false;
		} 
		if ($cpf == "00000000000") {
			return false;
		} 
		
		for ($i = 1; $i <= 9; $i++) {
			$soma = $soma + intval(substr($cpf, $i-1, 1)) * (11 - $i);
		}
		$resto = ($soma * 10) % 11;
		if (($resto == 10) || ($resto == 11)) {
			$resto = 0;
		}
		if ($resto != intval(substr($cpf, 9, 1))) {
			return false;
		}
		$soma = 0;
		for ($i = 1; $i <= 10; $i++) {
		   $soma = $soma + intval(substr($cpf, $i-1, 1)) * (12 - $i);
		}
		$resto = ($soma * 10) % 11;
		if (($resto == 10) || ($resto == 11)) {
			$resto = 0;
		}
		if ($resto != intval(substr($cpf, 10, 1))) {
			return false;
		}
		return true;
	}
	
	/*
		Verifica se o e-mail é válido de acordo com alguns filtros padrões.
		Retorna true se for válido, false se não.
	*/
	public static function validaEmail($email) 
	{
		if ($email == "" || 
			$email == null || 
			($email != null && !filter_var($email, FILTER_VALIDATE_EMAIL))) {
			return false;
		}
		return true;
	}
	
	/*
		Verifica se o login é válido.
		Retorna true se for válido, false se não.
	*/
	public static function validaLogin($login) 
	{
		return (!($login == "" || $login == null));
	}
	
	
	/*
		Valida alguns dados antes de cadastrar o cliente.
		Retorna null se não houver problema ou um JSON com resposta 
		sobre o problema encontrado.
	*/
	public static function validaDadosClienteCadastro ($login, $email, $cpf) 
	{
		$resposta = null;
		
		if (Cliente::existeLogin($login)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'Login já cadastrado.'
			]);
		} else if (Cliente::existeEmail($email)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'E-mail já cadastrado.'
			]);
		} else if (Cliente::existeCPF($cpf)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'CPF já cadastrado.'
			]);
		} else if (!Cliente::validaCPF($cpf)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'CPF inválido.'
			]);
		} else if (!Cliente::validaEmail($email)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'E-mail inválido.'
			]);
		} else if (!Cliente::validaLogin($login)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'Login inválido.'
			]);
		}
		
		return $resposta;
		
	}
	
	
	
	/*
		Valida alguns dados antes de alterar o cliente.
		Similar ao método de cadastro, mas faz validação apenas se 
		o usuário tiver trocado os dados dos campos.
		
		Retorna null se não houver problema ou um JSON com resposta 
		sobre o problema encontrado.
	*/
	public static function validaDadosClienteAlteracao ($cliente, $login, $email, $cpf) 
	{
		$resposta = null;
		
		if ($cliente->login != $login && Cliente::existeLogin($login)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'Login já cadastrado.'
			]);
		} else if ($cliente->email != $email && Cliente::existeEmail($email)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'E-mail já cadastrado.'
			]);
		} else if ($cliente->cpf != $cpf && Cliente::existeCPF($cpf)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'CPF já cadastrado.'
			]);
		} else if (!Cliente::validaCPF($cpf)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'CPF inválido.'
			]);
		} else if (!Cliente::validaEmail($email)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'E-mail inválido.'
			]);
		} else if (!Cliente::validaLogin($login)) {
			$resposta = response()->json([
				'status' => 'error',
				'mensagem' => 'Login inválido.'
			]);
		}
		
		return $resposta;
	}
	
	
}
