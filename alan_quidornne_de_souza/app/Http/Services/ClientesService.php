<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Models\Cliente;
use App\User;

use Illuminate\Support\Facades\Auth;

class ClientesService
{
    public $listaOrdenacao = [
        'nm_cliente' => 'Nome',
        'telefone' => 'Telefone',
        'email' => 'E-mail',
        'cpf' => 'CPF',
        'endereco_completo' => 'Endereço completo'
    ];

    public function __construct()
    {
    }

    public function obterListaInicial(Request $request)
    {
        $clientes = Cliente::where('in_ativo', '=', 1)->paginate();
        return $clientes;
    }

    public function filtrar(Request $request)
    {
        $dados = $request->all();
        $clientes = Cliente::
                            where($this->filtro($dados))
                            ->orderBy($dados['campo_ordenacao'], $dados['tp_ordem'])
                            ->paginate();
        return $clientes;
    }

    private function filtro($dados){
        $condicao[] = ['clientes.in_ativo', '=', 1];

        extract($dados);

        if(isset($nm_cliente) && !empty($nm_cliente))
            $condicao[] = ['clientes.nm_cliente', 'like', "%$nm_cliente%"];

        if(isset($telefone) && !empty($telefone))
            $condicao[] = ['clientes.telefone', 'like', "%$telefone%"];

        if(isset($email) && !empty($email))
            $condicao[] = ['clientes.email', 'like', "%$email%"];

        if(isset($cpf) && !empty($cpf))
            $condicao[] = ['clientes.cpf', 'like', "%$cpf%"];

        if(isset($telefone) && !empty($telefone))
            $condicao[] = ['clientes.telefone', 'like', "%$telefone%"];

        return $condicao;
    }

    public function salvar(Request $request)
    {
        $dados = $request->all();

        if(isset($dados['id']) && !empty($dados['id'])){
            $this->atualizar($dados);
        }else {
            $this->adicionar($dados);
        }
    }

    private function adicionar($dados){
        $cliente = new Cliente();
        $cliente->usuario_id = Auth::user()->id;
        $cliente->nm_cliente = $dados['nm_cliente'];
        $cliente->telefone = $dados['telefone'];
        $cliente->email = $dados['email'];
        $cliente->cpf = $dados['cpf'];
        $cliente->endereco_completo = $dados['endereco_completo'];
        $cliente->in_ativo = 1;
        $cliente->save();
    }

    private function atualizar($dados){
        $cliente = Cliente::find($dados['id']);
        $cliente->nm_cliente = $dados['nm_cliente'];
        $cliente->telefone = $dados['telefone'];
        $cliente->email = $dados['email'];
        $cliente->cpf = $dados['cpf'];
        $cliente->endereco_completo = $dados['endereco_completo'];
        $cliente->save();
    }

    public function inativar($id){
        $cliente = Cliente::find($id);
        $cliente->in_ativo = 0;
        $cliente->save();
    }

    public function inativarClientesMarcados(Request $request)
    {
        if(!empty($request->input('ids'))){
            $ids = $request->input('ids');
            foreach($ids as $id){
                $this->inativar($id);
            }
        }
    }

    public function obterPorId($id)
    {
        return Cliente::find($id);
    }

    public function obterTodos()
    {
        return Cliente::where('in_ativo', '=', 1)->orderBy('nm_cliente', 'asc')->get();
    }

    public function qtdTotalRegistros()
    {
        return Cliente::where('in_ativo', '=', 1)->count();
    }
}