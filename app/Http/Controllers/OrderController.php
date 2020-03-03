<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Client;
use App\Http\Requests\Order as RequestsOrder;
use App\Models\OrderProducts;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = (new \Okipa\LaravelTable\Table)->model(Order::class)->routes([
            'index'   => ['name' => 'orders.index'],
        ])->destroyConfirmationHtmlAttributes(function (Order $order) {
            return [
                'data-confirm' => 'Are you sure you want to delete the user ' . $order->name . ' ?',
            ];
        })->query(function($query){
            $query->byAuthorizedUser();
        });
        $table->column('id')->title('Id')->sortable(true)->searchable();
        $table->column()->title('Client')->link(function($client){
            return route('clients.edit', $client);
        })->value(function($order){
            return $order->client->name;
        });
        $table->column('price')->title('Price');
        
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
        ->with('model', new Order())
        ->with('products', Product::get())
        ->with('clients', Client::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RequestsOrder  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsOrder $request)
    {
        $order = Order::create($request->all('client_id'));
        foreach ($request->all('products')['products'] as $product_id) {
            $product = Product::find($product_id);
            $order->products()->create([
                'product_id' => $product_id,
                'quantity' => $request->all('quantity')['quantity'][$product_id],
                'unit_price' => $product->price
            ]);
        }
        return redirect('orders')
        ->with('success', 'create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RequestsOrder  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsOrder $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
