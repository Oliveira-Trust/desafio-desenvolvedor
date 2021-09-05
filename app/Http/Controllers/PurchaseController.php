<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        return view('purchase.index')->with(['purchases' => $purchases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::whereHas('inventory', function ($q) {
            $q->where('amount', '>', '0');
        })->get();
        return view('purchase.create')->with(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
            $purchase = new Purchase;
            $user->purchases()->save($purchase);
            foreach ($request->data['data'] as $key => $data) {
                $product = Product::find($data[0]);
                if ($product->inventory->amount >= $data[2]) {
                    $purchase->products()->attach($product->id, ['amount' => $data[2]]);
                    $qtd = $product->inventory->amount - $data[2];
                    $product->inventory->update(['amount' => $qtd]);
                } else {
                    DB::rollback();
                    return response()->json(['status' => 'Quantidade do produto ' . $product->name . " indisponível! re-faça a compra!"]);
                }
            }


        return response()->json(['status' => 'Compra realizada com sucesso!']);


    }

    /**
     * Display the specified resource.
     *
     * @param int $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('purchase.show')->with(['purchase' => $purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $products = Product::all();
        return view('purchase.edit')->with([
            'purchase' => $purchase,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        DB::beginTransaction();
            $syncArray = [];
            $array = $request->data['data'];
            foreach ($purchase->products as $product) {
                $amount = $product->pivot->amount + $product->inventory->amount;
                $product->inventory()->update(['amount' => $amount]);
            }
            foreach ($array as $key => $data) {
                $syncArray[$data[0]] =  ['amount' => $data[2]];

                $product = Product::find($data[0]);
                if ($product->inventory->amount >= $data[2]) {
                    $qtd = $product->inventory->amount - $data[2];
                    $product->inventory->update(['amount' => $qtd]);
                } else {
                    DB::rollback();
                    return response()->json(['status' => 'Quantidade do produto ' . $product->name . " indisponível! re-faça a compra!"]);
                }
            }
            $purchase->products()->sync($syncArray);

        return response()->json(['status' => 'Edição realizada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        DB::transaction(function () use ($request, $ids) {
            foreach ($ids as $id) {
                $purchase = Purchase::find($id);
                if (!$purchase) {
                    return response()->json(['error' => "Erro ao deletar alguma compra!"]);
                }
                foreach ($purchase->products as $product) {
                    $amount = $product->pivot->amount + $product->inventory->amount;
                    $product->inventory()->update(['amount' => $amount]);
                }
                $purchase->delete();
            }
        });
        return response()->json(['status' => "produto(s) deletado(s) com sucesso!"]);
    }
}
