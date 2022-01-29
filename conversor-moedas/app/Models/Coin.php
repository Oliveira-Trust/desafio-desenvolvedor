<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function coinPriceBase(): HasMany
    {
        return $this->hasMany(CoinPrice::class, 'coin_base_id');
    }

    public function coinPriceConvert(): HasMany
    {
        return $this->hasMany(CoinPrice::class, 'coin_convert_id');
    }
}
