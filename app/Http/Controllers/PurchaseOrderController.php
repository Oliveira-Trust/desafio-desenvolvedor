<?php

namespace App\Http\Controllers;

use App\Product;
use App\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = new PurchaseOrder();
        $purchase->user_id = 1;
        $purchase->amount = 0;
        $purchase->save();
        // Esses dois metodos chamados abaixo podem ser refatorados e movidos para outro lugar
        $this->storeItems($request->all(), $purchase->id);
        $this->setAmount($purchase);
        //dd($purchase);
    }

    private function storeItems($input, $purchase_id) {
        foreach ($input['qtd'] as $key => $value) {
            if (!is_null($value)) {
                $unitary_price = Product::select('price')->find($key);
                DB::table('product_purchase')->insert([
                    'purchase_id' => $purchase_id,
                    'product_id' => $key,
                    'unitary_price' => $unitary_price->price,
                    'qtd' => $value,
                    'total_price' => $unitary_price->price * $value,
                ]);
            }
        }
    }

    private function setAmount($purchase) {
        $amount = DB::table('product_purchase')
            ->where('purchase_id', $purchase->id)
            ->sum('total_price');
        $purchase->amount = $amount;
        $purchase->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
}
