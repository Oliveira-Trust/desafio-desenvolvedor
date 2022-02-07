<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyExchange extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',
                           'initial_conversion_value',
                           'coin_exchange_from',
                           'coin_exchange_to',
                           'form_of_payment',
                           'target_currency_value',
                           'target_currency_purchased',
                           'payment_rate',
                           'conversion_rate',
                           'final_conversion_value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
