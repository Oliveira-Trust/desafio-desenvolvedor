<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Okipa\LaravelTable\Table as OkipaTable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $table = (new OkipaTable)->model(Products::class)->routes([
            'index'   => ['name' => 'produtos'],
            'create'  => ['name' => 'produto.cadastrar'],
            'edit'    => ['name' => 'produto.editar'],
            'destroy' => ['name' => 'produto.excluir'],
        ])->destroyConfirmationHtmlAttributes(function (Products $products) {
            return [
                'data-confirm' => 'Are you sure you want to delete the user ' . $products->name . ' ?',
            ];
        });
        $table->column('id')->title('Id')->sortable(true)->searchable();
        $table->column('price')->title('Preço')->sortable()->searchable();
        $table->column('name')->title('Nome')->sortable()->searchable();
        $table->column('ean')->title('Ean')->sortable()->searchable();

        return view('productsList')->with('table',$table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prodSave = new Products();
        $savedReturn = $prodSave->saveProducts($request);
        return view('productForm')->with(compact('savedReturn'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product =  Products::find($id);
        return view('productForm')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = new Products();
        $product = $products->find($id);
        $product->delete();
        return redirect('produtos')->with("success","Produto Deletado com sucesso");
    }
}
