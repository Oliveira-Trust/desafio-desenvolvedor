<?php

namespace App\Domains\Exchange\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeApisCurrencies extends Model
{
    use HasFactory;

    protected $fillable = [
        "exchange_api_slug", "currency_id", "description", "code"
    ];

    public function scopeFindCurrencyBySlug($query, $currency_id, $slug)
    {
        return $query->where('currency_id', $currency_id)
            ->where('exchange_api_slug', $slug)
            ->first();
    }
}
