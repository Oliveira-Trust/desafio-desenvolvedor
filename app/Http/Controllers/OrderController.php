<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProducts;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orderList = Order::all();

        $viewData = [
            'orderList' => $orderList,
        ];

        return view('dashboard.orders.list', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productList = Product::all();

        $viewData = [
            'productList' => $productList,
        ];
        return view('dashboard.orders.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'products' => ['required'],
        ]);

        $authUserId = Auth::id();

        $authUser = User::find($authUserId);

        $products = $request->input('products');

        $productsList = [];

        $newOrder = new Order;

        $newOrder->user = $authUserId;

        $orderValue = 0;

        $newOrder->status = 'Em aberto';

        foreach ($products as $key => $product) {
            $findedProduct = Product::find($product);
            $orderValue += floatval($findedProduct->price);
            array_push($productsList, $findedProduct);
        }

        $newOrder->value = $orderValue;

        $newOrder->save();

        foreach ($productsList as $product) {

            $newOrderProduct = new OrderProducts;

            $newOrderProduct->order = $newOrder->id;
            $newOrderProduct->product = $product->id;

            $newOrderProduct->save();

            unset($newOrderProduct);
        }

        return redirect()->route('orders.index')->with('success', 'Pedido adicionado com sucesso !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $findedOrder = Order::find($id);
        $productsId = OrderProducts::where('order', $id)->get();

        $products = [];

        foreach ($productsId as $productId) {
            $product = Product::find($productId)->first();
            array_push($products, $product);
        }

        $viewData = ['order' => $findedOrder, 'products' => $products];
        return view('dashboard.orders.show', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {

        $viewData = ['order' => $order];
        return view('dashboard.orders.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $newStatus = $request->input('status');

        $order->status = $newStatus;

        $order->save();

        return redirect()->route('orders.index')->with('success', 'Status do pedido atualizado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findedOrder = Order::find($id);
        $findedOrder->delete();

        return redirect()->route('orders.index')->with('success', 'Pedido removido com sucesso !');
    }

    public function search()
    {
        //
    }
}
