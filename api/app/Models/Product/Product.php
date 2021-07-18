<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = "products";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'category_id', 'description', 'color', 'size', 'price'
    ];

    protected $casts = [
        'category_id' => 'int',
        'size' => 'float',
        'price' => 'float',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->hasOne('App\Models\Product\Category', 'id', 'category_id');
    }
}