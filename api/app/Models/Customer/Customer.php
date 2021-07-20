<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = "customers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'cpf', 'address'
    ];

    /**
     * Get the orders for the customer.
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order\Order');
    }
}