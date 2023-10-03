<?php

namespace App\Models;

use App\Enums\PaymentType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrencyExchangeHistoric extends Model
{
    use HasUlids;

    protected $table = 'currencies_exchange_historic';

    protected $fillable = [
        'source_currency',
        'destination_currency',
        'currency_bid',
        'conversion_value',
        'payment_type',
        'payment_tax',
        'conversion_tax',
    ];

    protected $casts = [
        'source_currency' => 'string',
        'destination_currency' => 'string',
        'currency_bid' => 'float',
        'conversion_value' => 'float',
        'payment_type' => PaymentType::class,
        'payment_tax' => 'float',
        'conversion_tax' => 'float',
    ];

    protected static function booted(): void
    {
        static::creating(function (CurrencyExchangeHistoric $currencyExchangeHistoric) {
            $currencyExchangeHistoric->user_id = auth()->user()->id;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
