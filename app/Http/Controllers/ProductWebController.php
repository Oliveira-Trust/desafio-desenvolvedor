<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create.product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        try {
            Product::create($request->all());

            return back()->with('message', 'Registro cadastrado com sucesso.');
        } catch (\PDOException $e) {
            Log::error($e->getMessage());

            return back()->with('message', 'Não foi possível cadastrar o registro.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('show.product', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('edit.product', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            $product->update($request->all());

            return back()->with('message', 'Registro atualizado com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('message', 'Não foi possível atualizar o registro.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('products.index')
                ->with('message', 'Registro deletado com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('message', 'Não foi possível atualizar o registro.')->withInput();
        }
    }
}
