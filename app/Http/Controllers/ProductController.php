<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = (new \Okipa\LaravelTable\Table)->model(Product::class)->routes([
            'index'   => ['name' => 'product.index'],
            'edit'    => ['name' => 'product.edit'],
            'destroy' => ['name' => 'product.destroy'],
            'create'  => ['name' => 'product.create'],
            'show'  => ['name' => 'product.show'],
        ])->destroyConfirmationHtmlAttributes(function (Product $product) {
            return [
                'data-confirm' => 'Are you sure you want to delete the product ' . $product->name . ' ?',
            ];
        });
        $table->column('name')->title('Name')->sortable(true)->searchable();
        $table->column('ean')->title('EAN')->sortable()->searchable();
        $table->column('price')->title('Price')->sortable()->searchable();
        $table->column('user_id')->title('Usuário responsável')->sortable()->searchable()
        ->value(function($product){
            return $product->user->name;
        })
        ->link(function($product) {
            // return route('users.show', $product->user->id);
        });

        return view('list')
        ->with('table', $table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.form')->with('model',new Product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'ean' => 'required|numeric',
            'price' =>'required|numeric'
        ]);

        $product = new Product($validatedData);
        $product->save();

        return redirect()->route('product.index')
        ->with('success', "produto $product->name criado com Sucesso");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.form')->with('model', $product)->with('show',true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.form')->with('model', $product)->with('show',false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'ean' => 'required|numeric',
            'price' =>'required|numeric'
        ]);


        $product->update($validatedData);

        return redirect()->route('product.index')
        ->with('success', "produto $product->name atualizado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')
        ->with('success', "produto apagado com sucesso");

    }
}
