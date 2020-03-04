<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class Order extends Model
{
    //
    protected $table = 'orders';
    protected $fillable = ['user_id','status'];

    const PEDIDO_ABERTO = "aberto";
    const PEDIDO_PAGO = "pago";
    const PEDIDO_CANCELADO = "cancelado";


    public function products()
    {
        return $this->hasMany(OrderProducts::class);
    }

    public function saveOrder(Request $request)
    {
        $this->validate($request);
        $this->fill([
            "user_id" => Auth::id(),
            "status" => self::PEDIDO_ABERTO,
        ]);

        if($this->save())
        {
            $orderID = $this->id;
            //$request->session()->put(Auth::id(), $orderID);
            $this->products()->create(
                [
                    'product_id' => $request->productId,
                    'order_id' => $orderID,
                    'quantity' => $request->productQuantity
                ]
            );
            return $this;
        }
        return false;

    }

    public function finishOrder(){
        $order = self::findOrFail($orderID);
        $order->status = self::PEDIDO_PAGO;
        return $order->save();

    }

    private function validate(Request $request)
    {
        $request->validate([
            'productQuantity' => 'required',
        ]);
    }

}
