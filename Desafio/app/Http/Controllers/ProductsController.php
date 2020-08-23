<?php

namespace App\Http\Controllers;

use App\Models\ItenTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        $products =  $product->load('transactions');
        return response()->Json([
            'products' => $products,
            'res' => ' O recurso solicitado foi processado e retornado com sucesso.'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = [              
            'cost' => $request->cost,
            'name'  => $request->name
        ];           
        $product = Product::create($dados);                          
            if ($product) {
                return response()->Json([
                    'product'=> $product,
                    'res'=>'O recurso informado foi criado com sucesso.'
                ], 201);
            }
        return response()->Json([
            'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
        ], 422);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);     
        return response()->Json([
            'product'=> $product,
            'res'=>'O recurso solicitado foi processado e retornado com sucesso.'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {           
            $product = Product::findOrFail($id);

            if($product){
                 
                $data = $request->all();           
                $product->update($data);
                return response()->Json([
                    'product'=> $product,
                    'res'=>'O recurso informado foi alterado com sucesso.'
                ], 201);   
            } 
            return response()->Json([
                'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
            ], 422); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);        
        if($product->delete()){
            return response()->Json([
                'product'=> $product,
                'res'=>'O recurso informado foi deletado com sucesso.'
            ], 201);;  
        }
        return response()->Json([
            'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
        ], 422);
    }
}