<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_currency',
        'destination_currency',
        'value',
        'payment_method',
        'destination_currency_price',
        'selling_price',
        'payment_method_fee',
        'convertion_fee',
        'discounted_value'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class, 'payment_method', 'slug');
    }
}
