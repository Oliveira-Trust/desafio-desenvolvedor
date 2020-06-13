<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = "order_status";

    function order()
    {
        return $this->hasOne(Order::class);
    }
}
