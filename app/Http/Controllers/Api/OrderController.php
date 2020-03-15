<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UserOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function finallyOrder(Request $request)
    {
        $user = auth('api')->user();
        $products = $request->get('cart');

        $total = 0;
        foreach ($products as $prod){
            $total += $prod['price'] * $prod['qtd'];
        }

        $product = [
            'total' => $total,
            'items' => serialize($products)
        ];

        $order = $user->orders()->create($product);

        return response()->json($order);
    }

    public function index(Request $request)
    {
        $orders = auth('api')->user()->orders;

        if($data = $request->all()){

            $orders = auth()->user()->orders();

            if($data['status']){
                $data['status'] = $data['status'] == 'cancel' ? 0 : $data['status'];
                $orders = $orders->where('status', '=', $data['status']);
            }

            if($data['price_initial']){
                $orders = $orders->where('price', '>=', $data['price_initial']);
            }

            if($data['price_end']){
                $orders = $orders->where('price', '<=', $data['price_end']);
            }


            if($data['order']){
                $orders = $orders->orderBy($data['order'], 'desc')->get();
            }

        }

        return response()->json($orders);
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

        return response()->json($order);
    }

    public function ordersAll()
    {
        if(auth('api')->user()->access == 'USER')
            return response()->json(['error' => 'Você não tem permissão']);

        $orders = UserOrder::all();
        return response()->json($orders);
    }

    public function aproved($id)
    {
        if(auth()->user('api')->access == 'USER')
            return response()->json(['error' => 'Você não tem permissão']);

        $order = UserOrder::find($id);
        $order->status = 2;
        $order->save();

        return response()->json($orders);
    }
}
