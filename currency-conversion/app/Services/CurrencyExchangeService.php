<?php

namespace App\Services;

use App\ExternalLibs\AwesomeApi;

use App\Models\Configuration;

class CurrencyExchangeService
{

  public static function currencyConversion($data){

    $configuration = Configuration::first();
    $initialConversionValue = str_replace('.', '', $data['initial_conversion_value']);
    $initialConversionValue = str_replace(',', '.', $initialConversionValue);
    $initialConversionValue = (double) $initialConversionValue;
    $data['coin_exchange_from'] = $configuration->coin_exchange_from;
    $dataConversion = json_decode(AwesomeApi::getCoinConversion($data['coin_exchange_from'], $data['coin_exchange_to']));
    
    foreach($dataConversion->{$data['coin_exchange_to'] . $data['coin_exchange_from']} as $key => $value){
      if($key !== 'bid'){
        continue;
      }
      $targetCurrencyValue = (double)round($value, 2);
      break;
    }

    $paymentRate = self::getPaymentRate($data['form_of_payment'], $initialConversionValue);
    $conversionRate = self::getConversionRate($initialConversionValue);
    $finalConversionValue = $initialConversionValue - $paymentRate - $conversionRate;
    $targetCurrencyPurchased =  (double)round($finalConversionValue / $targetCurrencyValue,2);

    return ['coin_exchange_from' => $data['coin_exchange_from'],
            'coin_exchange_to' => $data['coin_exchange_to'],
            'form_of_payment' => $data['form_of_payment'],
            'initial_conversion_value' => $initialConversionValue,
            'target_currency_value' => $targetCurrencyValue,
            'target_currency_purchased' => $targetCurrencyPurchased,
            'payment_rate' => $paymentRate,
            'conversion_rate' => $conversionRate,
            'final_conversion_value' => $finalConversionValue];

  }

  private static function getPaymentRate($formOfPayment, $initialConversionValue){

    $configuration = Configuration::first();
    //TODO implementar crud de formas de pagamento
    $paymentRatePercent = $formOfPayment == 'Cartão'
                          ? $configuration->payment_rate_credit_card
                          : $configuration->payment_rate_ticket;
                          
    return round(($initialConversionValue * $paymentRatePercent) / 100, 2);

  }

  private static function getConversionRate($initialConversionValue)
  {
    $configuration = Configuration::first();
    $paymentConversionPercent = $initialConversionValue < $configuration->payment_conversion_value 
                                ? $configuration->payment_conversion_max 
                                : $configuration->payment_conversion_min;
    return round(($initialConversionValue * $paymentConversionPercent) / 100, 2);
  }

  public static function getCoinNamesAvailable($coin){
    
    $availableConversions = AwesomeApi::AvailabeConversion();
   
    $availableCoins = [];
    
    foreach($availableConversions as $key =>$value){
      $code = explode('-',$key);
      if($code[1] === $coin){
        $name = explode('/',$value);
        $availableCoins[$code[0]] = $name[0];
      }
    }

    ksort($availableCoins);
    
    return (object)$availableCoins;

  }

  public static function getAllCoinNamesAvailable()
  {

    $availableConversions = AwesomeApi::AvailabeConversion();

    $availableCoins = [];

    foreach ($availableConversions as $key => $value) {
      $code = explode('-', $key);
      $name = explode('/', $value);
      if(!in_array($code[0], $availableCoins)){
        $availableCoins[$code[0]] = $name[0];
      }
    }

    ksort($availableCoins);

    return (object)$availableCoins;

  }

}
