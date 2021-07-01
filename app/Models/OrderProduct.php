<?php

namespace App\Models;

class ProductOrder extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'value',
        'quantity',
    ];



    
	/**
     * relationships
     *
     * @return void
     */
}
