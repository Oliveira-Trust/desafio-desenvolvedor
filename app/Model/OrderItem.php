<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';

    protected $fillable = [
        'order_id',
        'catalog_id',
        'catalog_sku',
        'qty',
        'price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function catalog()
    {
        return $this->hasOne(Product::class, 'catalog_id');
    }

}
