<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public function user()
    {
        return $this->belongsTo(Order::class);
    }

    function product()
    {
        return $this->belongsToMany(Product::class, "order_products");
    }

    function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
