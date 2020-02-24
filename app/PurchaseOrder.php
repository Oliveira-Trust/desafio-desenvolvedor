<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use Filterable;

    protected $fillable = [
        'user_id', 'amount',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_purchase')
            ->withPivot(['unitary_price', 'qtd', 'total_price']);
    }

    public function customer()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
