<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'customer_id', 'code', 'order_total_price', 'status'];

    public function setOrderTotalPriceAttribute($value)
    {
        $this->attributes['order_total_price'] = str_replace(',', '.', str_replace('.', '', $value));
    }

    public function getOrderTotalPriceAttribute($value)
    {
        return str_replace('.', ',', $value);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->using(OrderProduct::class)
            ->withTimestamps()
            ->withPivot('id', 'amount', 'total_price');
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function updateTotalPriceOrder($order_id, $total_price)
    {
        $updateOrder = Order::find($order_id);
        $updateOrder->order_total_price = (float) $updateOrder->order_total_price - (float) $total_price;
        $updateOrder->save();
    }
}
