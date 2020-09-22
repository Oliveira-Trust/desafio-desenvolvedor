<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = User::all();
        return view('admin.cliente.index', compact('clientes'));
    }

    public function adicionar()
    {
        return view('admin.cliente.adicionar');
    }

    public function editar($id)
    {
        $registro = User::find($id);
        if (empty($registro->id)) {
            return redirect()->route('admin.clientes');
        }
        return view('admin.cliente.editar', compact('registro'));
    }

    public function salvar(Request $req)
    {
        $dados = $req->all();

        User::create($dados);

        $req->session()->flash('admin-mensagem-sucesso', 'Cliente Cadastrado Com Sucesso!');

        return redirect()->route('admin.clientes');
    }

    public function atualizar(Request $req, $id)
    {
        $dados = $req->all();

        User::find($id)->update($dados);

        $req->session()->flash('admin-mensagem-sucesso', 'Cliente Atualizado Com Sucesso!');

        return redirect()->route('admin.clientes');
    }

    public function deletar(Request $req, $id)
    {

        User::find($id)->delete();

        $req->session()->flash('admin-mensagem-sucesso', 'Cliente Deletado Com Sucesso!');

        return redirect()->route('admin.clientes');
    }
}