<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use \App\Http\Traits\UsesUuid;

    public function products()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }
}
