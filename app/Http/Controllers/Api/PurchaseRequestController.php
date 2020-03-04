<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PurchaseRequest;

class PurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseRequests = PurchaseRequest::all();
        
        return response()->json($purchaseRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = filter_var_array($request, FILTER_SANITIZE_STRIPPED);
        
        $product = \App\Product::find($request->id_product);
        $client = \App\Product::find($request->id_client);
        
        if (!$product || !$client) {
            return response()->json(['error' => 'Dados inválidos.']);
        }
        
        $purchase = new PurchaseRequest();
        $purchase->id_client = $client->id;
        $purchase->id_product = $product->id;
        $purchase->quantity = $request->quantity;
        $purchase->status = $request->status;
        $purchase->price_total = $product->price * $request->quantity;
        
        if (!$purchase->save()) {
            return response()->json(['error' => 'Erro ao cadastrar o pedido, verifique os dados.']);
        }
        
        return response()->json(['success' => 'Pedido cadastrado com sucesso!']);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function show($id)
    {
        $purchase = PurchaseRequest::find($id);
        
        return response()->json(['purchase' => $purchase]);
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
        $request = filter_var_array($request, FILTER_SANITIZE_STRIPPED);
        
        $purchase = PurchaseRequest::find($id);
        
        $product = \App\Product::find($request->id_product);
        $client = \App\Product::find($request->id_client);
        
        if (!$product || !$client) {
            return response()->json(['error' => 'Dados inválidos.']);
        }
        
        $purchase->id_client = $client->id;
        $purchase->id_product = $product->id;
        $purchase->quantity = $request->quantity;
        $purchase->status = $request->status;
        $purchase->price_total = $product->price * $request->quantity;
        
        if (!$purchase->save()) {
            return response()->json(['error' => 'Erro ao editar o pedido, verifique os dados.']);
        }
        
        return response()->json(['success' => 'Pedido alterado com sucesso!']);
    }

    /**
     * 
     * @param PurchaseRequest $purchaseRequest
     * @return type
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        PurchaseRequest::destroy($purchaseRequest->id);
        
        return response()->json(['success' => 'Pedido excluído com sucesso!']);
    }
}
