<?php

namespace App\Library;

use Domain\Currency\CurrencyType;
use Domain\Payment\PaymentType;
use Illuminate\Support\Carbon;

class Format
{
  public function formatPurchaseData(array $data): array
  {
    foreach ($data as $key => $value) {
      $formatted_origin_currency = $this->getCurrency($data[$key]['origin_currency']);
      $formatted_destiny_currency = $this->getCurrency($data[$key]['destiny_currency']);
  
      $data[$key]['origin_value'] = "$formatted_origin_currency {$data[$key]['origin_value']}";
      $data[$key]['destiny_value'] = "$formatted_destiny_currency {$data[$key]['destiny_value']}";
  
      $data[$key]['payment_type'] = $this->getPaymentType($data[$key]['payment_type']);
  
      if ( isset($data[$key]['created_at'])) {
        $data[$key]['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $data[$key]['created_at'])->format('d/m/Y H:i');
      }
  
      $destiny_currency_price = sprintf("%.2f", $data[$key]['destiny_currency_price']);
  
      $data[$key]['destiny_currency_price'] = "{$formatted_destiny_currency} {$destiny_currency_price}";
  
      $data[$key]['payment_fee'] = "{$formatted_origin_currency} {$data[$key]['payment_fee']}";
      $data[$key]['exchange_fee'] = "{$formatted_origin_currency} {$data[$key]['exchange_fee']}";
  
      $data[$key]['net_value'] = "{$formatted_origin_currency} {$data[$key]['net_value']}";
    }

    return $data;
  }

  protected function getCurrency(string $currency): string
  {
    return match ($currency) {
      CurrencyType::USD->value => 'U$',
      CurrencyType::BRL->value => 'R$',
      CurrencyType::EUR->value => '€',
    };
  }

  protected function getPaymentType(string $payment_type): string
  {
    return match ($payment_type) {
      PaymentType::Boleto->value => 'Boleto',
      PaymentType::Cartao->value => 'Cartão',
    };
  }
}