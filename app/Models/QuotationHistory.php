<?php

namespace App\Models;

use App\Helpers\FormatsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationHistory extends Model
{
    use HasFactory;
    use FormatsTrait;

    protected $fillable = [
        'currency_origin',
        'target_currency',
        'value_origin',
        'value_origin_with_discount',
        'rate_payment',
        'rate_convert',
        'value_target_currency',
        'value_base_convert',
        'payment_method',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formatvalueToBrl(string $field, string $prefix = 'BRL'): mixed
    {
        return $this->formatCurrencyToBrl($this->{$field}, $prefix);
    }
}
