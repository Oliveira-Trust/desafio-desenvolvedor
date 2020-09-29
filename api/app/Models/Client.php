<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id'];

    public function orders()
    {
        return $this->belongsToMany(Product::class, 'orders', 'client_id', 'product_id')
                ->withPivot(['id','product_id','status','quantity'])
                ->withTimestamps();
    }
}
