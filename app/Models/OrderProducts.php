<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    //
    protected $table = 'order_products';
    protected $fillable = ['product_id','quantity','order_id'];

    public function product() {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }

}
