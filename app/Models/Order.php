<?php

namespace App\Models;

use App\Models\Traits\ByUser;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use ByUser;

    protected $fillable = [
        'client_id'
    ];

    public function products()
    {
        return $this->hasMany(OrderProducts::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function getPriceAttribute()
    {
        return $this->products()->sum('unit_price');
    }
}
