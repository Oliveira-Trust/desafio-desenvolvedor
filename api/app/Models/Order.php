<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'status', // Possible statuses: PAID, OPEN, CANCELLED 
        'quantity_ordered'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'product_id', 'client_id',
    ];

    /**
    * The relationships that should always be loaded.
    *
    * @var array
    */
    protected $with = ['client', 'product'];

    /**
    * Client relationship
    */
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    /**
    * Product relationship
    */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
