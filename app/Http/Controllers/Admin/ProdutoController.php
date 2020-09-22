<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('admin.produto.index', compact('produtos'));
    }

    public function adicionar()
    {
        return view('admin.produto.adicionar');
    }

    public function editar($id)
    {
        $registro = Produto::find($id);
        if( empty($registro->id) ) {
            return redirect()->route('admin.produtos');
        }
        return view('admin.produto.editar', compact('registro'));
    }

    public function salvar(Request $req)
    {
        $dados = $req->all();

        Produto::create($dados);

        $req->session()->flash('admin-mensagem-sucesso', 'Produto Cadastrado Com Sucesso!');

        return redirect()->route('admin.produtos');
    }

    public function atualizar(Request $req, $id)
    {
        $dados = $req->all();

        Produto::find($id)->update($dados);

        $req->session()->flash('admin-mensagem-sucesso', 'Produto Atualizado Com Sucesso!');

        return redirect()->route('admin.produtos');
    }

    public function deletar(Request $req, $id)
    {
        Produto::find($id)->delete();

        $req->session()->flash('admin-mensagem-sucesso', 'Produto Deletado Com Sucesso!');

        return redirect()->route('admin.produtos');
    }
}
