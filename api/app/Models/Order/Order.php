<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = "orders";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'customer_id',
        'status'
    ];

    protected $casts = [
        'user_id' => 'int',
        'customer_id' => 'int'
    ];

    /**
     * Get the products for the order.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product\Product')
            ->orderBy('order_product.id')
            ->withPivot('id', 'quantity', 'price');;
    }

    /**
     * Get the users for the order.
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    /**
     * Get the customer for the order.
     */
    public function customer()
    {
        return $this->hasOne('App\Models\Customer\Customer', 'id', 'customer_id');
    }

}