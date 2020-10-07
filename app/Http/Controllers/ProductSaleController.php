<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Models\ProductSale;
use App\Models\Sale;
use App\Models\Product;
use App\Models\User;

class ProductSaleController extends Controller
{
    public function list($order_by='created_at') {
        $direction = 'desc';
        $product_sale = ProductSale::orderBy($order_by, $direction)->paginate(10);
        $lenght = count($product_sale);

        if($lenght == 0) return abort(204);

        return $product_sale;
    }

    public function show($id) {
        $product_sale = ProductSale::findOrFail($id);
        return $product_sale;
    }

    public function store(Request $request){
        try {

            $product = Product::find($request->product_id);
            if($product == null)
                return response()->json(['message' => "Product doesn't exist."], 404);

            $sale = Sale::find($request->sale_id);
            if($sale == null)
                return response()->json(['message' => "Sale doesn't exist."], 404);

            $user = User::find($request->user_id);
            if($user == null)
                return response()->json(['message' => "User doesn't exist."], 404);

            $product_sale = ProductSale::create([
                'product_id' => $product->id,
                'sale_id' => $sale->id,
                'user_id' => $user->id,
                'amount' => $request->amount,
            ]);

            return response()->json(['product_sale' => $product_sale], 201);
        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function update(Request $request, $id){
        try {
            $product_sale = ProductSale::where('id', $id)->update($request->all());

            if($product_sale) return ['sale' => $id];

            return response()->json(['message' => "Sale doesn't exist."], 404);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function delete($id){
        try {
            $product_sale = ProductSale::findOrFail($id);
            $product_sale->delete();

            return ['Product deleted with success'];

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }
}
