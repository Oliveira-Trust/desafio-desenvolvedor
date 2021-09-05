<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index')->with(['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatorRules = [
            'name' => 'required|string|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'amount' => 'required|numeric'
        ];
        $request->validate($validatorRules);
        DB::transaction(function () use ($request) {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price
            ]);
            $product->inventory()->create(["amount" => $request->amount]);
        });
        return redirect()->route('product.index')->with(['status'=>'sucesso']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @id  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit')->with(['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatorRules = [
            'name' => 'required|string|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?/',
            'amount' => 'required|numeric'
        ];
        $request->validate($validatorRules);

        $prod = $product;
        DB::transaction(function () use ($request,$prod) {
            $prod->update([
                'name' => $request->name,
                'price' => $request->price
            ]);
            $prod->inventory->update(['amount' => $request->amount]);
        });
        return redirect()->route('product.index')->with(['status'=>'sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        DB::transaction(function () use ($request,$ids){
        foreach ($ids as $id) {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['error'=>"Erro ao deletar algum produto!"]);
            }
                $product->delete();
        }
        });
        return response()->json(['status'=>"produto(s) deletado(s) com sucesso!"]);
    }
}
