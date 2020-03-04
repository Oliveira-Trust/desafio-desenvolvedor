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
        $this->fill([
            "user_id" => Auth::id(),
            "status" => self::PEDIDO_ABERTO,
        ]);

        if($this->save())
        {
            $products = json_decode($request->products,true);

            foreach ($products as $product){
                if(empty($product)){
                    continue;
                }
                $this->products()->create(
                    [
                        'product_id' => $product["productId"],
                        'quantity' => $product["productQuantity"]
                    ]
                );
            }

            return $this;
        }
        return false;

    }



}
