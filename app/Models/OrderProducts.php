<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class OrderProducts extends Model
{
    use HasUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders_products';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * Get table name
     *
     * @return string
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qnt', 'price', 'order_id', 'product_id'
    ];
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['product'];

    /**
     * Get the uuid string.
     *
     * @param  string  $value
     * @return string
     */
    public function getUuidAttribute($value)
    {
        return (string) $value;
    }

    /**
     * Get the order record associated with the orderProcut.
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'uuid');
    }

    /**
     * Get the product record associated with the orderProcut.
     */
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'uuid', 'product_id');
    }
}
