<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Grid\GridManagement;
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
        $table = GridManagement::listOrdersGrid();

        return view('Lists.listOrders')->with('listOrders',$table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $table = GridManagement::orderGrid();

        return view('createOrder')->with('order',$table);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $order = new Order();
        return $order->saveOrder($request);

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
        $order = new Order();
        $softDelete = $order->find($id);
        if($softDelete->delete()){
            return redirect('pedidos')->with("success","Pedido Deletado com sucesso");
        }

        return redirect('pedidos')->with("errors","Pedido Não deletado");
    }

}
