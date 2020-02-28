<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['description', 'price', 'quantity', 'tag'];

    /**
     * Relationship one to many with purchase.
     */
    public function purchases()
    {
        return $this->hasMany('App\Model\Purchase');
    }

    /**
     * Change common to dot in price.
     */
    public function setPriceAttribute($value)
    {
        return $this->attributes['price'] = str_replace(',', '.', $value);
    }

    /**
     * Format price to number.
     */
    public function getPriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
}
