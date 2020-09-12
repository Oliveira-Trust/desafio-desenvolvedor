<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use App\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            
            $produto = new Produto();
            $rest = $produto->listarProduto();
            return response()->json($rest, 200);
           
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        try {
            $produto = new Produto();
            $rest = $produto->inserirProduto($request);
            return  response()->json($rest, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $produtos = new Produto();
            $rest = $produtos->findListarProduto($id);
            
            return response()->json($rest, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }
    public function view_produto()
    {
        return view('produto');
    }

    public function view_novo_produto()
    {
        return view('novo_produto');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request,  $id)
    {
        try {
            $produto = new Produto();

            $ret = $produto->alterarProduto($id, $request);
            return response()->json([
                $ret
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
