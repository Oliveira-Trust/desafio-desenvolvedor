<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['client_id', 'product_id', 'quantity', 'status'];

    /**
     * Relationship many to one with client.
     */
    public function client()
    {
        return $this->belongsTo('App\Model\Client');
    }

    /**
     * Relationship many to one with product.
     */
    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
