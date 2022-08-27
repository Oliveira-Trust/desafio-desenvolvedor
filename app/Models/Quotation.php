<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_currency_acronym',
        'source_currency_symbol',
        'target_currency_acronym',
        'target_currency_symbol',
        'target_currency_quote',
        'payment_method_fee_amount',
        'payment_method_fee_percentage',
        'conversion_fee_amount',
        'conversion_fee_percentage',
        'source_amount',
        'source_taxed_amount',
        'target_amount',
        'payment_method',
        'payment_status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
