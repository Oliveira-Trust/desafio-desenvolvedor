<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'value', 'origin_coin',
                          'destination_coin', 'value_with_discount',
                          'payment_method', 'value_buy'];
}
