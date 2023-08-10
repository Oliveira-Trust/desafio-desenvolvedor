<?php

namespace Modules\Conversion\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model {

    protected $fillable = ['currency_destiny_symbol', 'currency_origin_symbol', 'payment_type', 'currency_origin_name', 'currency_destiny_name', 'currency_destiny_conversion', 'currency_origin_value_with_tax', 'currency_destiny_value', 'payment_tax', 'conversion_tax', 'currency_origin_value'];

}
