<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exchange extends Model
{
    use HasFactory;

    protected $table = 'exchanges';

    protected $fillable = [
        'user_id',
        'origin_currency',
        'end_currency',
        'amount',
        'payment_method_id',
        'end_currency_amount',
        'payment_fee',
        'conversion_fee',
        'amount_converted',
    ];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo('payment_method_id', 'id');
    }
}
