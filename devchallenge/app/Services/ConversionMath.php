<?php

namespace App\Services;

use App\Actions\CurrencyApi;
use App\Models\PaymentMethod;
use App\Models\CurrencyDestiny;
use App\Models\ConversionHistory;
use App\Models\Tax;
use App\Helpers\Functions;
use Illuminate\Validation\ValidationException;
use Exception;

class ConversionMath
{
    public function calcConversion($request){
        try{
            $value = Functions::defaultNumberFormat($request->value);

            $taxDiscount = self::calcTax($value);
            $paymentDiscount = self::calcPayment($request->payment_method, $value);

            $destiny = CurrencyDestiny::findOrFail($request->destiny);
            $destinyCurrency = CurrencyApi::execute($destiny->name);

            $value = $value - ($taxDiscount + $paymentDiscount);

            $value = ($value / $destinyCurrency->bid);

            $data = [
                'origin' => $request->origin,
                'destiny' => $destiny->name,
                'user_id' => auth()->user()->id,
                'value' => $request->value,
                'payment_method_id' => $request->payment_method,
                'destiny_currency_value' => Functions::defaultNumberFormat($destinyCurrency->bid),
                'purchased_value' => Functions::defaultNumberFormat($value),
                'payment_tax' => Functions::defaultNumberFormat($taxDiscount),
                'conversion_tax' => Functions::defaultNumberFormat($paymentDiscount)
            ];

            $response = ConversionHistory::create($data);

            return $response;

        } catch (Exception $e){
            throw ValidationException::withMessages(['Error in conversion']);
        }
    }

    private static function calcTax($value){
        try{
            $tax = Tax::all();
            
            $above = $tax->firstWhere('application', 'above');
            if($value >= $above->value){
                $taxDiscount = $value * ($above->percent/100);
            }

            $below = $tax->firstWhere('application', 'below');
            if($value < $below->value){
                $taxDiscount = $value * ($below->percent/100);
            } 

            return $taxDiscount;
        } catch (Exception $e){
            throw ValidationException::withMessages(['Error in conversion']);
        }
    }

    private static function calcPayment($paymentMethod, $value){
        try{

            $payment = PaymentMethod::findOrFail($paymentMethod);
            return $value * ($payment->value/100);

        } catch (Exception $e){
            throw ValidationException::withMessages(['Error in conversion']);
        }
    }


}