<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProducts extends Model
{
    //
    use SoftDeletes;

    protected $table = 'order_products';
    protected $fillable = ['product_id','quantity','order_id','status'];

    public function product() {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }

}
