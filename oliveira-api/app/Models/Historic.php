<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment',
        'fee',
        'origin_currency',
        'destination_currency',
        'currency_value',
        'destination_currency_value',
        'purchased_value',
        'payment_fee',
        'conversion_fee',
        'conversion_value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
