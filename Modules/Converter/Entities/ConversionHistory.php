<?php

namespace Modules\Converter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Converter\Helpers\FormatHelper;
use Modules\User\Entities\User;

class ConversionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination_currency',
        'value_to_convert',
        'payment_method',
        'destination_currency_value',
        'purchase_value',
        'payment_fee',
        'conversion_fee',
        'final_conversion_value'
    ];

    /**
     * Mutators
     */
    public function setPurchaseValueAttribute($value)
    {
        $this->attributes['purchase_value'] = FormatHelper::currencyStringToFloat($value);
    }

    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
