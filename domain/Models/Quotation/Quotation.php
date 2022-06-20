<?php

namespace Oliveiratrust\Models\Quotation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Oliveiratrust\Models\Currency\Currency;
use Oliveiratrust\Models\CurrencyPrice\CurrencyPrice;
use Oliveiratrust\Models\PaymentType\PaymentType;
use Oliveiratrust\Models\User\User;

class Quotation extends Model {

    use HasFactory;

    protected $fillable = ['user_id', 'payment_type_id', 'currency_id', 'currency_price_id', 'amount', 'price', 'fees', 'exchanged_amount'];

    protected $casts = [
        'fees' => 'array'
    ];

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
