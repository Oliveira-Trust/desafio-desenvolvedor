<?php

namespace App\Http\Controllers;

use App\UserOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function finallyOrder()
    {
        $user = auth()->user();
        $products = session()->get('cart');

        $total = 0;
        foreach ($products as $prod){
            $total += $prod['price'] * $prod['qtd'];
        }

        $product = [
            'total' => $total,
            'items' => serialize($products)
        ];

        $user->orders()->create($product);

        session()->forget('cart');
        return redirect()->route('home');
    }

    public function index(Request $request)
    {
        $orders = auth()->user()->orders;
        $filtros = [
            'status'         => '',
            'price_initial' => '',
            'price_end'     => '',
            'order'         => ''
        ];

        if($data = $request->all()){

            $orders = auth()->user()->orders();

            if($data['status']){
                $filtros['status'] = $data['status'];
                $data['status'] = $data['status'] == 'cancel' ? 0 : $data['status'];
                $orders = $orders->where('status', '=', $data['status']);
            }

            if($data['price_initial']){
                $filtros['price_initial'] = $data['price_initial'];
                $orders = $orders->where('price', '>=', $data['price_initial']);
            }

            if($data['price_end']){
                $filtros['price_end'] = $data['price_end'];
                $orders = $orders->where('price', '<=', $data['price_end']);
            }


            if($data['order']){
                $filtros['order'] = $data['order'];
                $orders = $orders->orderBy($data['order'], 'desc')->get();
            }

        }

        return view('order.index', [
            'orders' => $orders,
            'filters' => $filtros
        ]);
    }

    /**apr
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = UserOrder::find($id);

        $order['items'] = unserialize($order['items']);
        $order['date'] = date('d/m/Y', strtotime($order['created_at']));

        return response()->json($order);
    }

    public function cancel($id)
    {
        $order = UserOrder::find($id);
        $order->status = 0;
        $order->save();

        return redirect()->route('order.index')->with('success', 'Pedido cancelado com sucesso!');
    }

    public function ordersAll()
    {
        if(auth()->user()->access == 'USER')
            return redirect()->route('home');

        $orders = UserOrder::all();
        return view('order.index', compact('orders'));
    }

    public function aproved($id)
    {
        if(auth()->user()->access == 'USER')
            return redirect()->route('home');

        $order = UserOrder::find($id);
        $order->status = 2;
        $order->save();

        return redirect()->route('order.all')->with('success', 'Pedido Aprovado!');
    }
}
