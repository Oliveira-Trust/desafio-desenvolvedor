<?php

namespace App\Models;

use App\Http\Requests\CoinConvertionRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    // For implement after; Currently has default configs to test in migrations
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'payment_methods',
        'fee_level_one',
        'fee_limit_level_one',
        'fee_level_two',
        'fee_limit_level_two',
        'active_currency',
        'max_value_convertion',
    ];

    public function getEnabledPayments()
    {
        try {
            // Get separated array separated by ",": 'x:1,y:2,z:3' == ['x:1', 'y:2', 'z:3']
            $paymentMethodsArray = explode(',', $this->payment_methods);

            $paymentMethodsConfiguredArray = [];

            // Get first key separated by ":": ['x:1', 'y:2', 'z:3'] => first loop => 'x:1' == ['x', '1'] => getting 'x'
            foreach($paymentMethodsArray as $pma) {
                $paymentMethodsConfiguredArray[] = explode(':', $pma)[0] ?? null;
            }

        } catch ( \Exception $e ) {
            return false;
        }

        return $paymentMethodsConfiguredArray;
    }

    public function getEnabledCurrencies()
    {
        return explode(',', $this->active_currency);
    }

}
