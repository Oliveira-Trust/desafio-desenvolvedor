<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $table = 'conversion';

    protected $fillable = [
        'user_id',
        'base_currency',
        'target_currency',
        'value',
        'payment_method_id',
        'target_currency_value',
        'purchased_value',
        'payment_fee',
        'conversion_fee',
        'effective_value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
