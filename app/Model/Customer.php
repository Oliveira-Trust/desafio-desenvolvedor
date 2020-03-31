<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
        'name',
        'email',
        'document',
        'phone',
        'status'
    ];

}
