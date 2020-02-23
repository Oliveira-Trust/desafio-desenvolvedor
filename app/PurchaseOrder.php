<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'user_id', 'amount',
    ];

    public function products() {
        return $this->belongsToMany('App\Product', 'product_purchase')
            ->withPivot(['qtd', 'total_price']);
    }

    public function customer() {
        return $this->belongsTo('App\User');
    }
}
