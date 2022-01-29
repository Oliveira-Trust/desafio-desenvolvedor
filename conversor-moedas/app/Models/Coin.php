<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function coinPrices(): HasMany
    {
        return $this->hasMany(CoinPrice::class, 'coin_base_id');
    }

    public function coinConversions(): HasMany
    {
        return $this->hasMany(CoinPrice::class, 'coin_convert_id');
    }

    public function scopeWithPrices(Builder $query): Builder
    {
        return $query->with([
            'coinPrices',
            'coinPrices.coinConvert'
        ]);
    }

    public function scopeWithConversions(Builder $query): Builder
    {
        return $query->with([
            'coinConversions',
            'coinConversions.coinBase'
        ]);
    }
}
