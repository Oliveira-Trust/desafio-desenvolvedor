<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable = [
        'total', 'users_id', 'order_status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "users_id", "id");
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, "order_products", "orders_id", "products_id")->withPivot('quantity');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
