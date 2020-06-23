<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Order extends Model
{
    use HasUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_orders';

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
        'user_id', 'client_id', 'status_id'
    ];
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['products', 'client', 'status'];

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
     * Get the products record associated with the order.
     */
    public function products()
    {
        return $this->hasMany('App\Models\OrderProducts', 'order_id', 'uuid');
    }

    /**
     * Get the client record associated with the order.
     */
    public function client()
    {
        return $this->hasOne('App\Models\Client', 'uuid', 'client_id');
    }

    /**
     * Get the status record associated with the order.
     */
    public function status()
    {
        return $this->hasOne('App\Models\Status', 'uuid', 'status_id');
    }
}
