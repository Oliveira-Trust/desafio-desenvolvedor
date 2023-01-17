<?php

namespace App\Domains\Exchange\Models;

use App\Domains\PaymentMethod\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $with = ['paymentMethod', 'currencyTo', 'currencyFrom'];

    protected $table = "exchanges";

    protected $fillable = [
        "currency_id_to",
        "currency_id_from",
        "payment_method_id",
        "amount_from",
        "amount_from_net",
        "bid_amount",
        "amount_to_net",
        "exchange_fee_amount",
        "payment_method_fee_amount",
        "user_id"
    ];

    public function currencyTo()
    {
        return $this->belongsTo(Currency::class,"currency_id_to");
    }

    public function currencyFrom()
    {
        return $this->belongsTo(Currency::class, "currency_id_from");
    }
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
