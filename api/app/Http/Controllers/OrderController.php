<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends AbstractController
{
    /**
    * Define the Model for abstract Controller
    */
    protected function getModel()
    {
        return Order::class;
    }
    
    /**
    * Validate the request for abstract Controller
    */
    protected function modelValidation(Request $request)
    {
        $request->validate([
            'client' => 'required|numeric',
            'product' => 'required|numeric',
            'quantity_ordered' => 'required|numeric',
        ],
        [
            'client.required' => 'Especifique o cliente',
            'product.required' => 'Especifique o produto',
            'quantity_ordered.required' => 'Quantidade encomendada é obrigatória',
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->modelValidation($request);

        $data = $request->all();
        $order = new Order;
        $request->client ? $order->client()->associate($request->client) : null;
        $request->product ? $order->product()->associate($request->product) : null;

        if ($request->quantity_ordered > $order->product->available_quantity) {
            return response()->json(['success' => false, 'data' => [], 'message' => 'Não há produtos suficientes para este pedido']);
        }

        $order->fill($data);
        $order->save();
        return response()->json(['success' => true, 'data' => $order]);
    }
}
