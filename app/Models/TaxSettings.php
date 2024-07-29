<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxSettings extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'boleto_fee',
        'credit_card_fee',
        'conversion_fee_below_3000',
        'conversion_fee_above_3000',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
