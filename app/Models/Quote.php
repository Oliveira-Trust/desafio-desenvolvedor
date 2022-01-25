<?php

declare(strict_types=1);

namespace App\Models;


/**
 * @property $currency
 * @property $value
 * @property $methodPayment
 * @property $priceCurrency
 * @property $methodPaymentFee
 * @property $conversionFee
 * @property $discountedValue
 */
class Quotations extends BaseModel
{
    protected $table = 'quotation';

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


}