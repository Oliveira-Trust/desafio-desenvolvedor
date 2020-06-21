<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Client extends Model
{
    use HasUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

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
        'name', 'dob', 'user_id', 'status_id'
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
     * Get the address record associated with the client.
     */
    public function address()
    {
        return $this->hasMany('App\Models\Address', 'client_id', 'uuid');
    }

    /**
     * Get the contact record associated with the client.
     */
    public function contact()
    {
        return $this->hasMany('App\Models\Contact', 'client_id', 'uuid');
    }

    /**
     * Get the status record associated with the client.
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'uuid');
    }
}
