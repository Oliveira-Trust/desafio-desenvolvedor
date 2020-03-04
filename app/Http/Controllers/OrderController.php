<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Okipa\LaravelTable\Table as OkipaTable;

class OrderController extends Controller
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

    public function index()
    {
        $table = (new OkipaTable)->model(Products::class)->routes([
            'index'   => ['name' => 'produtos'],
            'create'  => ['name' => 'produto.cadastrar'],
            'edit'    => ['name' => 'produto.editar'],
            'destroy' => ['name' => 'produto.excluir'],
        ]);
        $table->column('id')->classes(['productId'])->title('Id')->sortable(true)->searchable();
        $table->column('price')->classes(['productPrice'])->title('Preço')->sortable()->searchable();
        $table->column('name')->classes(['productName'])->title('Nome')->sortable()->searchable();
        $table->column('ean')->classes(['productEan'])->title('Ean')->sortable()->searchable();
        $table->column('quantity')->title('Quantidade')->html(
            function(){
                return '<input type="number" name="productQuantity" class="form-group productQuantity" id="productQuantity">';
            }
        );
        $table->column('action')->title('adiciona ao carrinho')->html(
            function(){
                return '<button class="btn btn-success" id="btnAddCart"></button>';
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
        //@todo salvar id do pedido na sessao para os proximos produtos e adicionar evento jquery mostrando o carrinho/
        $order = new Order();
        $orderExistToUser = session(Auth::id());
        if(empty($orderExistToUser)){
            return $order->saveOrder($request);
        }
        $order->find($orderExistToUser);
        $order->products()->create(
            [
                'product_id' => $request->productId,
                'order_id' => $orderExistToUser,
                'quantity' => $request->productQuantity
            ]
        );
        return $order;
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
