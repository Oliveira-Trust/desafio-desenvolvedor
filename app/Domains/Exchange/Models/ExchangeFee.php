<?php

namespace App\Domains\Exchange\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeFee extends Model
{
    use HasFactory;

    protected $table = "exchange_fees";
    protected $fillable = [
        "amount_min", "amount_max", "fee"
    ];

    public function scopeFindByAmount($query, $amount)
    {
        return $query->where([
            [
                "amount_min", "<", $amount
            ],
            [
                "amount_max", ">", $amount,
            ]
        ])->first();
    }

}
