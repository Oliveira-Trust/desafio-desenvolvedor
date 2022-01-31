<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoinConvertion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'currency_origin',
        'currency_destin',
        'conversion_value',
        'payment_method',
        'current_quote_destin',
        'purchased_total',
        'payment_fee',
        'convertion_fee',
        'used_value_currency_conversion',
        'config_id',
        'status',
    ];

    public function config()
    {
        return $this->hasOne(Config::class, 'id', 'config_id');
    }
}
