<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeRule extends Model
{
    use HasFactory;

    public static function getConversionFee($amount)
    {
        foreach (self::all()->toArray() as $rule) {
            if (($rule['rule'] === '<' && $amount < $rule['value']) ||
                ($rule['rule'] === '>=' && $amount >= $rule['value'])
            ) {
                return $rule['fee'];
            }
        }

        return 0;
    }
}
