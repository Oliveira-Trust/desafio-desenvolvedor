<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Status",
 *      required={"name", "ref_table", "enable", "status"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ref_table",
 *          description="ref_table",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="enable",
 *          description="enable",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Status extends Model
{
    use SoftDeletes;

    public $table = 'statuses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'ref_table',
        'enable',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'ref_table' => 'string',
        'enable' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'ref_table' => 'required',
        'enable' => 'required',
        'status' => 'required'
    ];

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
     * Get status ref
     *
     * @return string
     */
    public static function getRefTables()
    {
        return [
            'clients' => __('Client'),
            'products' => __('Product'),
            'purchase_orders' => __('Order'),
        ];
    }

    /**
     * Get status label
     *
     * @return string
     */
    public static function getStatusLabel()
    {
        return __("status.state.status");
    }

    /**
     * Get enable label
     *
     * @return string
     */
    public static function getEnableLabel()
    {
        return __("status.state.enable");
    }

    /**
     * Get image url
     *
     * @param  string  $value
     * @return string
     */
    public function getReferenciaAttribute($value)
    {
        return url($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clients()
    {
        return $this->hasMany(\App\Models\Client::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function purchaseOrders()
    {
        return $this->hasMany(\App\Models\PurchaseOrder::class, 'status_id');
    }
}
