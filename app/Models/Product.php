<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Product extends Model
{
    use HasUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

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
        'name', 'description', 'image', 'price', 'user_id', 'status_id'
    ];
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['status'];

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
     * Get image url
     *
     * @param  string  $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return url($value);
    }

    /**
     * Get the user record associated with the product.
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'uuid', 'user_id');
    }

    /**
     * Get the status record associated with the product.
     */
    public function status()
    {
        return $this->hasOne('App\Models\Status', 'uuid', 'status_id');
    }
}
