<?php

namespace App\Domains\PaymentMethod\Models;

use App\Domains\Exchange\Models\Exchange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = "payment_methods";

    protected $fillable = [
        "description", "fee"
    ];

    public function exchanges()
    {
        return $this->hasMany(Exchange::class);
    }
}
