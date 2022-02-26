<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'code_in',
        'conversion_value',
        'payment_rate',
        'conversion_rate',
        'conversion_value_tax',
        'purchased_value',
        'destination_currency_value',
        'tax',
        'payment_method',
        'user_id',
        'created_at'
    ];

    protected $dataFormat = 'd/m/Y H:i:s';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
