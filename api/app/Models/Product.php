<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'name', 'price', 'available_quantity', 'tags'
    ];

    /**
    * Order Relationship 
    */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
