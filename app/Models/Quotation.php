<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    const ORIGIN_CURRENCY = 'BRL';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method_id',
        'origin_currency',
        'destination_currency',
        'quotation',
        'payment_tax',
        'conversion_tax',
        'conversion_amount',
        'conversion_net_amount',
        'destination_currency_available',
    ];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
