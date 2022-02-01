<?php

namespace Domain\PaymentMethod\Models;

use Domain\Fees\Models\Fees;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentMethod extends Model
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function fees(): HasOne
    {
        return $this->hasOne(Fees::class);
    }
}
