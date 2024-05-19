<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'payment_method_id',
        'currency',
        'target_currency',
        'payment_method',
        'amount',
        'payment_fee',
        'amount_fee',
        'bid',
        'target_amount',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
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
