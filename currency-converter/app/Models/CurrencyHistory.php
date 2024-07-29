<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_currency',
        'target_currency',
        'amount',
        'payment_method',
        'exchange_rate',
        'converted_amount',
        'payment_fee',
        'conversion_fee'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
