<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoinPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'coin_base_id',
        'coin_convert_id',
        'value',
        'reference'
    ];

    protected $casts = [
        'reference' => 'date'
    ];

    public function coinBase(): BelongsTo
    {
        return $this->belongsTo(Coin::class, 'coin_base_id');
    }

    public function coinConvert(): BelongsTo
    {
        return $this->belongsTo(Coin::class, 'coin_convert_id');
    }

    public function conversions(): HasMany
    {
        return $this->hasMany(Conversion::class);
    }
}
