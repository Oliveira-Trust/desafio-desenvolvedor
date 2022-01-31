<?php


namespace App\EloquentModels\Customer;

use App\Traits\BootUuids;
use Illuminate\Database\Eloquent\Model;

class CustomerExchange extends Model
{
    use BootUuids;

    public $incrementing = false;
    protected $connection = 'sqlite_customer';
    protected $table = 'customer_exchanges';
    protected $casts = [
        'id'          => 'uuid',
        'customer_id' => 'uuid',
        'exchange'    => 'object'
    ];
    protected $fillable = [
        'id',
        'customer_id',
        'exchange',
        'created_at',
        'update_at'
    ];
    protected $dates = [
        'created_at',
        'update_at'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

}

