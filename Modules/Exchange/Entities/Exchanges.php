<?php

namespace Modules\Exchange\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Exchange\Enums\Currency;
use Modules\Exchange\Enums\PaymentMethod;
use Modules\User\Entities\User;

class Exchanges extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'origin_currency',
        'destination_currency',
        'conversion_value',
        'payment_method',
        'exchange',
        'pay_rate_value',
        'exchange_rate_value',
        'pay_rate',
        'exchange_rate',
        'conversion_value_with_fees',
        'purchased_value',
    ];

    protected $casts = [
        'origin_currency'            => Currency::class,
        'destination_currency'       => Currency::class,
        'payment_method'             => PaymentMethod::class,
        'conversion_value'           => 'float',
        'exchange'                   => 'float',
        'pay_rate_value'             => 'float',
        'exchange_rate_value'        => 'float',
        'pay_rate'                   => 'float',
        'exchange_rate'              => 'float',
        'conversion_value_with_fees' => 'float',
        'purchased'                  => 'float'
    ];

    /** @return BelongsTo  */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
