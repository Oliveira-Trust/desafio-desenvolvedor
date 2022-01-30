<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'coin_price_id',
        'value'
    ];

    public function coinPrice(): BelongsTo
    {
        return $this->belongsTo(CoinPrice::class);
    }
}
