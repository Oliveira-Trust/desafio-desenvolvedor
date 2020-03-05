<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class Order extends Model
{
    // Como pedido é algo importante a deleção e feita por softdelete
    use SoftDeletes;

    protected $table = 'orders';
    protected $fillable = ['client_id'];

    const PEDIDO_ABERTO = "aberto";
    const PEDIDO_PAGO = "pago";
    const PEDIDO_CANCELADO = "cancelado";


    public function products()
    {
        return $this->hasMany(OrderProducts::class);
    }

    public function client(){
        return $this->hasOne(Client::class,'id','client_id');
    }

    public function orderValue($id){
        $order = self::find($id);
        $total = 0;
        foreach ($order->products as $product){
            $total += $product->product->price * $product->quantity;
        }
        return $total;
    }

    public function saveOrder(Request $request)
    {

        $productsOrders = json_decode($request->products,true);
        $validate = $this->validate($productsOrders);

        if(!empty($validate)){
            dd($validate);
            return $validate;
        }

        foreach ($productsOrders as $productsOrder){
            if(empty($productsOrder)){
                continue;
            }
            $this->fill([
                'client_id' => $productsOrder["selectClient"],

            ]);
            $this->save();

            $this->products()->create(
                [
                    'status' => $productsOrder["statusOrder"],
                    'product_id' => $productsOrder["productId"],
                    'quantity' => $productsOrder["productQuantity"]
                ]
            );

        }

        return $this;


    }

    private function validate($request)
    {
        $errors = [];
        foreach($request as $field => $value){
            if(empty($field)){
                $errors[] = "Field ".$field." is required!";
            }
        }
        return $errors;
    }

}
