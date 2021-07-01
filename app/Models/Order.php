<?php

namespace App\Models;

class Order extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'total',
        'status',
        'paid_at',
    ];

}
