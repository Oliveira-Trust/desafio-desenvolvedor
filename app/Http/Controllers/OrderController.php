<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Okipa\LaravelTable\Table as OkipaTable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = (new OkipaTable)->model(Products::class)->routes([
            'index'   => ['name' => 'produtos'],
            'create'  => ['name' => 'produto.cadastrar'],
            'edit'    => ['name' => 'produto.editar'],
            'destroy' => ['name' => 'produto.excluir'],
        ]);
        $table->column('id')->classes(['idProduto'])->title('Id')->sortable(true)->searchable();
        $table->column('price')->classes(['precoProduto'])->title('Preço')->sortable()->searchable();
        $table->column('name')->classes(['nameProduto'])->title('Nome')->sortable()->searchable();
        $table->column('ean')->classes(['eanProduto'])->title('Ean')->sortable()->searchable();
        $table->column('quantity')->title('Quantidade')->html(
            function(){
                return '<input type="number" name="orderQuantity" class="form-group orderQuantity" id="orderQuantity">';
            }
        );
        $table->column('action')->title('adiciona ao carrinho')->html(
            function(){
                return '<button  name="orderQuantity" class="btn btn-success" id="btnAddCart"></button>';
            }
        );

        return view('createOrder')->with('order',$table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
