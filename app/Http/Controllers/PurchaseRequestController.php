<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PurchaseRequest;

class PurchaseRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $requests = PurchaseRequest::all();
        
        $status = [0 => 'Cancelado', 1 => 'Em Aberto', 2 => 'Pago'];
        
        return view('purchase-requests.index', ['requests' => $requests, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = \App\Client::all();
        $products = \App\Product::all();
        return view('purchase-requests.create', ['clients' => $clients, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = \App\Product::find($request->id_product);
        $client = \App\Product::find($request->id_client);
        
        if (!$product || !$client) {
            return redirect()->route('purchase-request.index');
        }
        
        $purchase = new PurchaseRequest();
        $purchase->id_client = $client->id;
        $purchase->id_product = $product->id;
        $purchase->quantity = $request->quantity;
        $purchase->status = $request->status;
        $purchase->price_total = $product->price * $request->quantity;
        
        $purchase->save();
        
        return redirect()->route('purchase-requests.index');
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
     * 
     * @param type $id
     * @return type
     */
    public function edit($id)
    {
        $purchase = PurchaseRequest::find($id);
        
        $clients = \App\Client::all();
        $products = \App\Product::all();
        
        return view('purchase-requests.edit', [
            'request' => $purchase, 
            'clients' => $clients, 
            'products' => $products
        ]);
    }

    /**
     * 
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function update(Request $request, $id)
    {
        $purchase = PurchaseRequest::find($id);
        
        $product = \App\Product::find($request->id_product);
        $client = \App\Product::find($request->id_client);
        
        if (!$product || !$client) {
            return redirect()->route('purchase-request.index');
        }
        
        $purchase->id_client = $client->id;
        $purchase->id_product = $product->id;
        $purchase->quantity = $request->quantity;
        $purchase->status = $request->status;
        $purchase->price_total = $product->price * $request->quantity;
        
        $purchase->save();
        
        return redirect()->route('purchase-requests.index');
    }

    /**
     * 
     * @param PurchaseRequest $purchaseRequest
     * @return type
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        PurchaseRequest::destroy($purchaseRequest->id);
        
        return redirect()->route('purchase-requests.index');
    }
    
    public function destroySelected(Request $request)
    {
        PurchaseRequest::destroy($request->ids);
        return;
    }
}
