<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title', 'description', 'price',
    ];

    public function order()
    {
        return $this->belongsToMany(Order::class, "order_products", "orders_id", "products_id")->withPivot('quantity');
    }
}
