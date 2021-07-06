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
        'category_id',
        'description',
        'enabled',
    ];



    
	/**
     * relationships
     *
     * @return void
     */
	public function category() { return $this->belongsTo(Category::class); }
	public function order() { return $this->belongsToMany(Product::class, 'order_products', 'product_id', 'order_id'); } //?
}
