<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'price',
    ];

    public function order()
    {
        return $this->belongsToMany(Order::class, "order_products");
    }
}
