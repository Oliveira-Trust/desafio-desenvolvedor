<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrencyHistoric extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_currency',
        'destination_currency',
        'amount',
        'payment_method',
        'rate',
        'converted_amount',
        'tax_payment',
        'tax_conversion',
        'amount_after_taxes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
