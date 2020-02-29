<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produtos;

class ProdutosWebController extends Controller
{
    public function index()
    {
        Return view('produtos.lista');
    }

    public function show($id)
    {

        if(is_numeric($id)){
            $produto = Produtos::find($id);

            Return view('produtos.show', ['produto' => $produto]);
        }else{
            return response()->json([
                'message'   => 'Record not found',
                'code'   => 404,
            ], 404);
        }
    }
}
