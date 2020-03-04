<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = filter_var_array($request, FILTER_SANITIZE_STRIPPED);
        
        $product = new Product();
        $product->name = $request->name;
        $product->price = str_replace(['.', ','], ['', '.'], $request->price);
        
        if (!$product->save()) {
            return response()->json(['error' => 'Erro ao cadastrar o produto, verifique os dados.']);
        }
        
        return response()->json(['success' => 'Produto cadastrado com sucesso!']);
    }

    /**
     * 
     * @param Product $product
     * @return type
     */
    public function show(Product $product)
    {
        return response()->json(['product' => $product]);
    }

    /**
     * 
     * @param Request $request
     * @param Product $product
     * @return type
     */
    public function update(Request $request, Product $product)
    {
        $request = filter_var_array($request, FILTER_SANITIZE_STRIPPED);
        
        $product->name = $request->name;
        $product->price = str_replace(['.', ','], ['', '.'], $request->price);
        
        if (!$product->save()) {
            return response()->json(['error' => 'Erro ao editar o produto, verifique os dados.']);
        }
        
        return response()->json(['success' => 'Produto alterado com sucesso!']);
    }

    /**
     * 
     * @param Product $product
     * @return type
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        
        return response()->json(['success' => 'Produto excluído com sucesso!']);
    }
}
