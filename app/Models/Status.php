<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Status extends Model
{
    use HasUuid;

    const ENABLED = 1;
    const DISABLED = 0;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'statuses';

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
        'name', 'ref_table', 'enable', 'status'
    ];

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
}
