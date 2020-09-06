<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use \App\Http\Traits\UsesUuid;

    public function owner()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

}
