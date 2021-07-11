<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{

    public function loja()
    {
        $produtos = Produto::simplePaginate(5);
        return view('loja.index', compact('produtos'));
    }

    public function inserirPedidoDetalhe()
    {
        return 'ok';
    }

    //Lista com os produtos
    public function index(Request $request)
    {

        $produtos = Produto::simplePaginate(5);

        if(isset($request)) 
        {
            //$produtos = Produto::orderBy($request->sort,$request->direction)->simplePaginate(5);
        }

        return view('produtos.index', compact('produtos'));
    }

    //Tela para criação de produto
    public function create()
    {
        return view('produtos.create');
    }

    //Salva o registro de produto
    public function store(Request $request)
    {
        Produto::create($request->except('_token'));
        return redirect()->route('produto_index')
            ->with('success', 'Produto salvo com sucesso');
    }

    //Tela para edição de produto
    public function edit(int $id)
    {
        $produto = Produto::find($id);
        
        return view('produtos.edit',compact('produto'));
    }

    public function update(int $id, Request $request, Produto $produto)
    {
        $request->validate([
            'descricao' => 'required',
            'valor' => 'required',
            'quantidade' => 'required'
        ]);

        $produto->find($id)->update($request->all());

        return redirect()->route('produto_index')
            ->with('success', 'Produto salvo com sucesso');
    }

    public function destroy(int $id, Produto $produto)
    {
        $produto->find($id)->delete();

        return redirect()->route('produto_index')
            ->with('success', 'Produto salvo com sucesso');
    }
}