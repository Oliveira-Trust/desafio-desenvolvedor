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
        'origin_coin',
        'destin_coin',
        'current_quote_origin',
        'conversion_value',
        'form_payment',
        'config_id',
    ];

    public function config()
    {
        return $this->hasOne(Config::class);
    }
}
