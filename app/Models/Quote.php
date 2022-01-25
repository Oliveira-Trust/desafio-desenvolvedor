<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $currency
 * @property $value
 * @property $methodPayment
 * @property $priceCurrency
 * @property $methodPaymentFee
 * @property $conversionFee
 * @property $discountedValue
 */
class Quote extends BaseModel
{
    protected $table = 'quotes';

    /** @var string[] */
    protected $fillable = [
        'currency',
        'value',
        'methodPayment',
        'priceCurrency',
        'finalValue',
        'methodPaymentFee',
        'conversionFee',
        'discountedValue',
        'userId'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
