<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    //Tela para criação de produto
    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
