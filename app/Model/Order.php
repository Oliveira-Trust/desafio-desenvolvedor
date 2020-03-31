<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'grand_total',
        'final_price',
        'discount',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class );
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id' );
    }

}
