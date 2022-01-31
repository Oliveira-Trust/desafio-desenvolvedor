<?php


namespace App\EloquentModels\Customer;

use App\Traits\BootUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use BootUuids;
    use SoftDeletes;

    public $incrementing = false;
    protected $connection = 'sqlite_customer';
    protected $table = 'customers';
    protected $casts = [
        'id'   => 'string',
        'name' => 'string'
    ];
    protected $fillable = [
        'id',
        'name',
    ];


    public function exchanges()
    {
        return $this->hasMany(CustomerExchange::class, 'customer_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'customer_id', 'id');
    }
    public function sendExchangeRate()
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}

