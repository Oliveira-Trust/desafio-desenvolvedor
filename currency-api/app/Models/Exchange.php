<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_currency',
        'destination_currency',
        'original_amount',
        'payment_method',
        'amount_in_destination_currency',
        'payment_method_fee',
        'conversion_fee',
        'total_with_fees',
    ];

    protected $casts = [
        'original_amount' => 'float',
        'amount_in_destination_currency' => 'float',
        'payment_method_fee' => 'float',
        'conversion_fee' => 'float',
        'total_with_fees' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method', 'id');
    }
}
