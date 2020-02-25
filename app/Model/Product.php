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
}
