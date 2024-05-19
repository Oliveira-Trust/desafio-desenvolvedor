<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'rate',
        'type',
        'is_enabled',
        'amount',
        'min_amount_rate',
        'max_amount_rate',
        'payment_method_id',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopePaymentMethod($query, int $paymentMethodId)
    {
        return $query->where('payment_method_id', $paymentMethodId);
    }
}
