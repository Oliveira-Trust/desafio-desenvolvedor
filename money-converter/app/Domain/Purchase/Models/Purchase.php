<?php

namespace Domain\Purchase\Models;

use Domain\PaymentMethod\Models\PaymentMethod;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'payment_type_id',
        'origin',
        'destiny',
        'quotation_value',
        'payment_fees',
        'conversion_fees',
        'request_value',
        'purchase_value',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
