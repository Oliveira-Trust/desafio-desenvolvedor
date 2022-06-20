<?php

namespace Oliveiratrust\Models\Fee;

use Illuminate\Database\Eloquent\Model;
use Oliveiratrust\Models\FeeType\FeeType;
use Oliveiratrust\Models\PaymentType\PaymentType;

class Fee extends Model {

    protected $fillable = ['fee_type_id', 'payment_type_id', 'min_amount', 'max_amount', 'percent', 'fixed_value'];

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
