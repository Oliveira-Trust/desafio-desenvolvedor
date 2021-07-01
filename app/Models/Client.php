<?php

namespace App\Models;

class Client extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document',
        'phone_number',
        'phone_number2',
        'birth',
        'address_zipcode',
        'address_street',
        'address_number',
        'address_complement',
        'address_neighborhood',
        'city_id',
    ];
}
