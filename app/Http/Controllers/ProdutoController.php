<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{

    //Tela para criação de produto
    public function create()
    {
        return view('produtos.create');
    }

    
    //Salva o registro de produto
    public function store(Request $request)
    {
        Produto::create($request->except('_token'));
    }
}