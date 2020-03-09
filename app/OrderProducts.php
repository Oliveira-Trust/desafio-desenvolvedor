<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\ForeignKeyDefinition;

class OrderProducts extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'unit_price'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
