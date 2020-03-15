<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $fillable = ['items', 'total', ''];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
