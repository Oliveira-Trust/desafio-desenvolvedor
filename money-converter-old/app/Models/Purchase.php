<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo};

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_type_id',
        'origin',
        'destiny',
        'quotation_value',
        'payment_taxe',
        'conversion_taxe',
        'request_value',
        'purchase_value',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }
}
