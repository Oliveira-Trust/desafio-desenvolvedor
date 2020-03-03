<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Product as RequestsProduct;

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
            'index'   => ['name' => 'products.index'],
            'edit'    => ['name' => 'products.edit'],
            'destroy' => ['name' => 'products.destroy'],
        ])->destroyConfirmationHtmlAttributes(function (Product $product) {
            return [
                'data-confirm' => 'Are you sure you want to delete the user ' . $product->name . ' ?',
            ];
        })->query(function($query){
            $query->byAuthorizedUser();
        });
        $table->column('name')->title('Name')->sortable(true)->searchable();
        $table->column('brand')->title('Brand')->sortable()->searchable();
        $table->column('price')->title('Price')->sortable()->searchable();
        
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
        return view('form')
        ->with('model', new Product());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RequestsProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsProduct $request)
    {
        Product::create($request->all('name', 'brand', 'price'));
        return redirect('products')
        ->with('success', 'create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('form')
        ->with('model', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RequestsProduct  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsProduct $request, Product $product)
    {
        $product->update($request->all('name', 'brand', 'price'));
        return redirect('products')
        ->with('success', 'save success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('products')->with('success','Product has been  deleted');
    }
}
