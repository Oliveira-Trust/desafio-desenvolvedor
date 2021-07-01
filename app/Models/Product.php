<?php

namespace App\Models;

class Product extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
        'value',
        'description',
        'enabled',
    ];



    
	/**
     * relationships
     *
     * @return void
     */
	public function category() { return $this->belongsTo(Product::class, 'category_id', 'id'); }
	public function order() { return $this->belongsToMany(Product::class, 'order_products', 'product_id', 'order_id'); } //?
}
