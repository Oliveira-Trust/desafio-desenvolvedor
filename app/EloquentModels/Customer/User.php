<?php

namespace App\EloquentModels\Customer;

use App\Notifications\Customer\SendExchangeRate;
use App\Traits\BootUuids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    use BootUuids;

    public $incrementing = false;
    protected $connection = 'sqlite_customer';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'id'           => 'uuid',
        'user_role_id' => 'uuid',
        'name'         => 'string',
        'email'        => 'string',
        'password'     => 'string',
    ];
    protected $dates = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];
    protected $fillable = [
        'id',
        'name',
        'email',
        'user_role_id',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function sendExchangeRate($echange)
    {
        $this->notify(new SendExchangeRate($echange, $this));
    }
}
