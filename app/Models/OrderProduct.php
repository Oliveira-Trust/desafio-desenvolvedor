<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{

    protected $fillable = ['id', 'order_id', 'customer_id', 'amount', 'total_price'];

    public function getTotalPriceAttribute($value)
    {
        return str_replace('.', ',', $value);
    }
}
