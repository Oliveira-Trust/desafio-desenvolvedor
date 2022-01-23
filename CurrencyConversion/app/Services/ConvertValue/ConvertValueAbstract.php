<?php

namespace App\Services\ConvertValue;

use App\Models\Currency;
use App\Models\CurrencyTax;
use App\Models\CurrencyConversion;
use App\Helper\ApiEconomiaAwesome;
use Illuminate\Support\Facades\Auth;

abstract class ConvertValueAbstract extends ConvertValueBase
{

    use ApiEconomiaAwesome;


    public function execConvertion() :? CurrencyConversion
    {

        $OriginValue        = $this->params['origin_value'];
        $PaymentMethod      = $this->params['payment_method'];
        $cur_id             = $this->params['cur_id'];
        $Currency           = Currency::findOrFail($cur_id);
        $CurrentQuote       = $this->getCurrentQuote($Currency->abbreviation, 'BRL');



        //  Calcula  as taxas
        $CurrencyTax        = CurrencyTax::first();
        $TaxPaymentMethod   = $this->getTaxByPaymentMethodCalculated($OriginValue, $PaymentMethod, $CurrencyTax);
        $Taxconversion      = $this->getTaxByAmountCalculated($OriginValue, $CurrencyTax);
        $UpdatedValue       = $OriginValue -  $Taxconversion - $TaxPaymentMethod;

        

        $data = [
            'origin_currency'       => 1,
            'cur_id'                => $cur_id,
            'origin_value'          => $OriginValue,
            'payment_method'        => $PaymentMethod,
            'tax_currency'          => (float)$CurrentQuote,
            'tax_payment_method'    => $TaxPaymentMethod,
            'tax_conversion'        => $Taxconversion,
            'converted_value'       => $UpdatedValue / $CurrentQuote,
            'updated_value'         => $UpdatedValue,
            'usu_id'                => Auth::user()->id,
        ];

        if(isset($this->id)) {
            return $this->convertedValueRepository->updateConvertedValue($data, $this->id);
        } else {
            return $this->convertedValueRepository->createConvertedValue($data);            
        }
    }




    private function getTaxByAmountCalculated(float $valueOrigin, $CurrencyTax)
    {

        if($valueOrigin <= $CurrencyTax->less_value) {
            $Tax = $CurrencyTax->less_tax;
        } else {
            $Tax = $CurrencyTax->bigger_tax;
        }



        return ($valueOrigin / 100) * $Tax;
    }


    private function getTaxByPaymentMethodCalculated(float $valueOrigin, $paymentMethod, $CurrencyTax)
    {

        if($paymentMethod == 'CREDIT_CARD') {
            $Tax = $CurrencyTax->tax_credit_card;
        } elseif($paymentMethod == 'BANK_SLIP') {
            $Tax = $CurrencyTax->tax_bank_slip;            
        }

        return ($valueOrigin / 100) * $Tax;

    }


}
