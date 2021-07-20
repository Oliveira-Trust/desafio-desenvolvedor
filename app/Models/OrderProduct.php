<?php

namespace App\Models;

class OrderProduct extends BaseModel
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
    public function product()
    {
        return $this->belongsTo(Product::class);
    } 
    
}
