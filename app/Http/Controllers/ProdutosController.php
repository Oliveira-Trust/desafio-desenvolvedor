<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
class ProdutosController extends Controller
{
    public function index()
    {
        $produto = \App\Models\Produto::all();
        return view('produtos.list',['produto'=> $produto]);
    }
    public function create()
    {
        return view('produtos.create');
    }
    public  function  store(Request $request)
    {
       
        \App\Models\Produto::create([
            'nome_produto' => $request->nome_produto,
            'custo_produto' => $request->custo_produto,
            'valor_produto' => $request->valor_produto,
            'quantidade_estoque' => $request->quantidade_produto,
        ]);
        
        return "Produto Criado Com sucesso!";
    }
    public function show($id)
    {
        $produto = \App\Models\Produto::findOrFail($id);
        return view('produtos.show',['produto'=> $produto]);
    }
    public  function  update(Request $request,$id)
    {
        $produto = \App\Models\Produto::findOrFail($id);
        $produto->update([
            'nome_produto' => $request->nome_produto,
            'custo_produto' => $request->custo_produto,
            'valor_produto' => $request->valor_produto,
            'quantidade_estoque' => $request->quantidade_produto,
        ]);
        
        return "Produto atualizado Com sucesso!";
    }
    
    public function delete($id)
    {
        $produto = \App\Models\Produto::findOrFail($id);
        return view('produtos.delete',['produto'=> $produto]);
    }
    
    public function destroy($id)
    {
        $produto = \App\Models\Produto::findOrFail($id);
        $produto->delete();
        return redirect('produtos/listar');
    }
    
    public function list()
    {
        $produto = \App\Models\Produto::all();
        return view('produtos.list',['produto'=> $produto]);
    }
}
