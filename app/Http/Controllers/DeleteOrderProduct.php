<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteOrderProduct extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        try {
            DB::beginTransaction();
            $deleteOrderProduct = OrderProduct::find($id);

            Product::updateStockProduct($deleteOrderProduct->product_id, $deleteOrderProduct->amount);
            Order::updateTotalPriceOrder($deleteOrderProduct->order_id, $deleteOrderProduct->total_price);

            $deleteOrderProduct->forceDelete();
            DB::commit();
            return response()->json([
                'status' => __('Product deleted from order'),
                'status-type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return response()->json([
                'status' => __('Failed to delete product from order'),
                'status-type' => 'warning'
            ]);
        }
    }
}
