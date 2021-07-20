<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = "order_product";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'price'
    ];

    protected $casts = [
        'user_id' => 'int',
        'customer_id' => 'int',
        'quantity' => 'int',
        'price' => 'float'
    ];

    /**
     * Get the users for the order.
     */
    public function product()
    {
        return $this->hasOne('App\Models\Product\Product', 'id', 'product_id');
    }

    /**
     * Get the customer for the order.
     */
    public function order()
    {
        return $this->hasOne('App\Models\Order\Order', 'id', 'order_id');
    }

}