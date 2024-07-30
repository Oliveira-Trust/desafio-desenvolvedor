<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $all)
 * @method static find($id)
 */
class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'source_currency',
        'target_currency',
        'original_amount',
        'payment_method',
        'payment_method',
        'conversion_fee',
        'converted_amount',
        'final_amount',
        'payment_fee',
        'value_target_currency',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
