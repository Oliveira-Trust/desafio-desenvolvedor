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

    public function produtosGet(){
        $produto = $this->produto->all();

        dd($produto);
    }

    public function produtoGet($id){

        $produto = $this->produto->findOrFail($id);

        dd($produto);
    }

    public function produtoCreate(Request $request){

        DB::transaction(function(){
            $produto = $this->produto->create($request->all());
        });

        dd($produto);

        return redirect(route('home'));
    }
    public function produtoUpdate($id, Request $request){
        $produto = $this->produto->findOrFail($id);

        DB::transaction(function(){
            $produto->update($request->all());
        });

        dd($produto);
        return redirect(route('home'));
    }
    public function produtoDelete($ids){
        
        DB::transaction(function(){
            foreach($ids as $id){
                $atualproduto = $this->produto->findOrFail($id);

                $atualproduto->delete();
            }
        });

        dd('hihi');
        return redirect(route('home'));
    }
}
