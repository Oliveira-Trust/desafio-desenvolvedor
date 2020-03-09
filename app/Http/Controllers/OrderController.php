<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Product;
use App\Client;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $table = (new \Okipa\LaravelTable\Table)->model(Order::class)->routes([
            'index'   => ['name' => 'order.index'],
            'edit'    => ['name' => 'order.edit'],
            // 'destroy' => ['name' => 'order.destroy'],
            'create'  => ['name' => 'order.create'],
            'show'  => ['name' => 'order.show'],
        ])->destroyConfirmationHtmlAttributes(function (Order $order) {
            return [
                'data-confirm' => 'Are you sure you want to delete the product ' . $order->name . ' ?',
            ];
        })->query(function($query){
            $query->byAuthorizedUser();
        });
        $table->column('client_id')->title('Cliente')->sortable()->searchable()
            ->value(function ($order) {
                return $order->client->name;
            })
            ->link(function ($order) {
                return route('client.show', $order->client->id);
            });
            if (auth()->user()->admin){
                $table->column('user_id')->title('Usuário')->sortable()->searchable()
                    ->value(function ($order) {
                        return $order->user->name;
                    });
            }
        $table->column('status')->title('Status')->sortable(true)->searchable();
        if (!stristr($request->userAgent(),'mobile')){
            $table->column('value')->title('Valor')->sortable()->searchable()
                ->value(function ($order) {
                    return 'R$ ' . number_format($order->calculateValue(), 2);
                });
            }
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
        return view('order.step1')
            ->with('clients', auth()->user()->clients);
    }

    public function step2(Request $request, Order $order)
    {
        // dd($order);
        if (!$order->id) {
            $client = Client::first('id', $request->all('client'));
            $order->client_id = $client->id;
            $order->save();
        }

        return view('order.step2')
            ->with('order', $order)
            ->with('products', Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $client = Client::find($request->input('client'));
        $order->client_id = $client->id;
        $order->save();
        return redirect()->action('OrderController@step2', ['order' => $order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('order.show')
            ->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('order.edit')
            ->with('order', $order)
            ->with('products', Product::all());
        // return redirect()->action('OrderController@new', ['order' => $order->id]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if (!$order->cancelOrder()){
            return back()->with('failed','Ação Proibida');
        }
        return redirect()->back();
    }

    public function addProduct(Request $request, Order $order)
    {
        if ($order->status != 'Pedido em digitação'){
            return back()->with('failed','pedido fechado');
        }
        $product = Product::find($request->input('product'));

        $order->products()->create([
            'product_id' => $product->id,
            'quantity' => $request->input('quantidade'),
            'unit_price' => $product->price
        ]);
        return back();
    }

    public function removeProduct(Request $request, Order $order)
    {
        foreach ($order->products as $product) {
            if ($product->id == $request->input('product')) {
                $product->delete();
            }
        }
        return redirect()->back();
    }

    public function confirmPayment(Request $request, Order $order)
    {
        // dd($order);
        if (!$order->confirmPayment()){
            return back()->with('failed','Ação Proibida');
        }
        return redirect()->back();
    }

    public function commit(Order $order)
    {
        if ($order->calculateValue() == 0){
            return back()->with('failed','pedido vazio');
        }
        if (!$order->commitOrder()){
            return back()->with('failed','Ação Proibida');
        }
        return redirect()->action('OrderController@show', ['order'=> $order->id]);
    }
}
