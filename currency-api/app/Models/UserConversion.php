<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_currency',
        'destination_currency',
        'original_amount',
        'payment_method',
        'amount_in_destination_currency',
        'payment_fee',
        'conversion_fee',
        'total_with_fees',
    ];

    protected $casts = [
        'original_amount' => 'decimal:2',
        'amount_in_destination_currency' => 'decimal:2',
        'payment_fee' => 'decimal:2',
        'conversion_fee' => 'decimal:2',
        'total_with_fees' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
