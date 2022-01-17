<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Cambio extends Model
{
    use HasFactory;

    public function Processing($request)
    {
        $data          = $request->all();

        $currency      = $this->TypeCurrency($data); // type currecy
        $valueConvert  = str_replace(['.',','],['','.'],$data['valor']); // value conversion
        $payment       = $data['pg']; // payment method
        $paymente_rate = ($payment=='boleto') ? 1.45 : 7.63; // rate payment
        $conversion_rate = ($valueConvert < 3000.00) ? 2 : 1; // rate conversion

        $currencyDestination = $this->CurrencyValue($data); 
        
        $value_discount_ope = ($valueConvert * $conversion_rate) / 100;
        $discount_conversion = $valueConvert - $value_discount_ope;// descout rate  conversion

        $valuePurchase = $discount_conversion / $currencyDestination; // conversion currency

        $value_discount_pay = ($valuePurchase * $paymente_rate) / 100; 
        $converted_value = $valuePurchase - $value_discount_pay;// converted value


        return \DB::table('conversations')->insertGetId([
            'origin_currency' => $currency->Origin, 
            'destination_currency' => $currency->Destination, 
            'conversion_value' => $valueConvert, 
            'payment' => $payment, 
            'value_purchase_currency_destination' => $currencyDestination, 
            'payment_rate' => $value_discount_pay, 
            'conversion_rate' => $value_discount_ope, 
            'converted_value' => $converted_value,
            'purchase_value' => $discount_conversion,
            'user_id' => Auth::user()->id
        ]);

    }
    

    public function TypeCurrency($data)
    {
        $currencyEX =  explode('-',$data['md']);

        $currency = new \stdclass();
        $currency->Origin      = $currencyEX[0];
        $currency->Destination = $currencyEX[1];

        return $currency;
    }

    public function CurrencyValue($data)
    {
        $xml = file_get_contents('http://economia.awesomeapi.com.br/xml/'.$data['md'].'/1');
        $xml = simplexml_load_string($xml);
        return 1/$xml->item->high;
    }
}
