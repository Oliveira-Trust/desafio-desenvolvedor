<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model {

    use HasFactory;

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function originCurrency() {
        return $this->belongsTo(Currency::class, 'origin_currency_id');
    }

    public function destinationCurrency() {
        return $this->belongsTo(Currency::class, 'destination_currency_id');
    }

}
