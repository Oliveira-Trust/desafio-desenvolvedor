<?php

namespace Oliveiratrust\Models\Quotation;

use Illuminate\Database\Eloquent\Model;
use Oliveiratrust\Models\Currency\Currency;
use Oliveiratrust\Models\CurrencyPrice\CurrencyPrice;
use Oliveiratrust\Models\PaymentType\PaymentType;
use Oliveiratrust\Models\User\User;

class Quotation extends Model {

    protected $fillable = ['user_id', 'payment_type_id', 'currency_id', 'currency_price_id', 'amount', 'fees', 'exchanged_amount'];

    protected $casts = [
        'fees' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function currencyPrice()
    {
        return $this->belongsTo(CurrencyPrice::class);
    }
}
