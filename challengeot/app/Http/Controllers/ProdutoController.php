<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use DB;

class ProdutoController extends Controller
{
    protected $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function produtoPage(){
        $produto = $this->produto->all();
        return view('produtos', compact('produto'));
    }

    public function produtosGet(){
        $produto = $this->produto->all();
    }

    public function produtoGet($id){
        $produto = $this->produto->findOrFail($id);
    }

    public function produtoCreate(Request $request){

        DB::transaction(function() use ($request){
            $produto = $this->produto->create($request->all());
        });

        return redirect(route('produtos'));
    }
    public function produtoUpdate($id, Request $request){
        $produto = $this->produto->findOrFail($id);

        DB::transaction(function() use ($produto, $request){
            $produto->update($request->all());
        });

        return redirect(route('produtos'));
    }
    public function produtoDelete($ids){

        $ids_produto = explode(',',$ids);
        
        DB::transaction(function() use ($ids_produto){
            foreach($ids_produto as $id){
                $atualproduto = $this->produto->findOrFail($id);

                $atualproduto->delete();
            }
        });
        return redirect(route('produtos'));
    }
}
