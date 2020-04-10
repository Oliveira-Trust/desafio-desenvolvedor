<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderController extends AbstractController
{
    /**
    * Define the Model for abstract Controller
    *
    * @return \Illuminate\Database\Eloquent\Model
    */
    protected function getModel()
    {
        return Order::class;
    }

    /**
    * Display a listing of the resource.
    *
    * @queryParam quantity_ordered int required The quantity ordered. Example: 20
    * @queryParam total int required The total value of the Order. Example: 10
    * @queryParam product_id int required The product id. Example: 1
    * @queryParam client_id int required The client id. Example: 1
    * @queryParam order_by array required array of key value. Key needs to be a attr of Order. Value can be either asc or desc. Example: ?order_by[created_at]=desc
    * @queryParam limit int required The limit of results. Example: 2
    * @queryParam offset int required The offset to skip number of results. Example: 1
    *
    * @param  Request  $request
    * @param  OrderRepositoryInterface  $orderRepository
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request, OrderRepositoryInterface $orderRepository)
    {
        $criterias = $request->except('order_by', 'limit', 'offset');
        $orders = $orderRepository->findBy($criterias, $request->order_by, $request->limit, $request->offset);
        return response()->json(['success' => true, 'data' => $orders]);
    }

    /**
    * Validate the request for abstract Controller
    *
    * @param  Request  $request
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
