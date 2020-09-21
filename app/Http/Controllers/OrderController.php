<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\ClientService;
use App\Services\OrderItemService;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderService, $clientService, $productService, $orderItemService;

    public function __construct(OrderService $orderService, ClientService $clientService, ProductService $productService, OrderItemService $orderItemService)
    {
        $this->orderService = $orderService;
        $this->clientService = $clientService;
        $this->productService = $productService;
        $this->orderItemService = $orderItemService;
        //$this->middleware('auth');
    }

    public function index()
    {
        $orders = $this->orderItemService->all();
        return view('order.index')->with(["orders" => $orders]);
    }

    public function create()
    {
        $clients = $this->clientService->all();
        $products = $this->productService->all();
        return view('order.create')->with([
            "clients" => $clients,
            "products" => $products
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        $this->orderService->save($request->all());
        return redirect('orders');
    }

    public function show($id)
    {
        $order = $this->orderItemService->find($id);
        $clients = $this->clientService->all();
        $products = $this->productService->all();
        return view('order.show')->with([
            "order" => $order,
            "clients" => $clients,
            "products" => $products
        ]);
    }

    public function edit($id)
    {
        $order = $this->orderItemService->find($id);
        $clients = $this->clientService->all();
        $products = $this->productService->all();

        return view('order.edit')->with([
            "order" => $order,
            "clients" => $clients,
            "products" => $products
        ]);
    }

    public function update(OrderStoreRequest $request, $id)
    {
        $this->orderItemService->update([
            "product_id" => $request->get('product_id'),
            "status" => $request->get('status'),
            "quantity" => $request->get('quantity'),
        ], $id);

        $orderItem = $this->orderItemService->find($id);
        $this->orderService->update([
            'client_id' => $request->get('client_id')
        ], $orderItem->order_id);

        return redirect('orders')->with("success", "Pedido alterado com sucesso");
    }

    public function destroy($id)
    {
        $this->orderItemService->destroy($id);
        return redirect()->back();
    }
}
