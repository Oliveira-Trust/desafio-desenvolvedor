<?php

namespace Domain\Exchange\Actions;

use Domain\Config\Enums\ConfigName;
use Domain\Config\Models\Config;
use Domain\Exchange\DataTransferObject\FetchDataData;
use Domain\Marketing\Email\Actions\EmailSenderAction;
use Domain\Payment\PaymentType;
use Illuminate\Http\Client\Factory as HttpClient;
use Domain\Exchange\Actions\CreateExchangeUsersAction;

class FetchDataAction
{
  public function __construct(
    public readonly HttpClient $httpClient,
    public readonly CreateExchangeUsersAction $createExchangeUsersAction,
    public readonly EmailSenderAction $emailSenderAction,
    public readonly Config $configModel,
  ) {
  }

  public function execute(FetchDataData $data): array
  {
    $result = $this->httpClient->get(
      "https://economia.awesomeapi.com.br/json/last/{$data->origin_currency}-{$data->destiny_currency}"
    )->body();

    /** Api data */
    $result = json_decode($result, true)["{$data->origin_currency}{$data->destiny_currency}"];

    /** Payment type and exchange fee values */
    $fee_values = $this->processFeeValues($data);

    /** Origin value net value with fees applied */
    $net_value = $this->processNetValue($data, $fee_values);
    
    /**
     * Destiny value
     * I was confused if I should use $result['low'] or $result['high']
     * The API docs doesn't make it clear, so I decided to use $result['low']
     */
    $destiny_value = $this->processDestinyValue($net_value, $result['low']);

    $exchange_data = [
      'destiny_currency_price' => $result['low'],
      'destiny_value' => $destiny_value,
      'payment_fee' => $fee_values['paymentFee'],
      'exchange_fee' => $fee_values['exchangeFee'],
      'net_value' => $net_value,
    ];

    if ( ! is_null($data->user_id)) {
      $exchange_user = $this->createExchangeUsersAction->execute($data->user_id, [
        'origin_currency' => $data->origin_currency,
        'destiny_currency' => $data->destiny_currency,
        'origin_value' => $data->origin_value,
        'payment_type' => $data->payment_type,
        ...$exchange_data,
      ]);

      $exchange_data['exchange_user_id'] = $exchange_user;
    }

 
    return $exchange_data;
  }

  protected function processFeeValues(FetchDataData $data): array
  {
    /** Returns the origin value formatted. 0,00 -> 0.00 */
    $origin_value = $data->formattedOriginValue();

    $fee_values = $this->getFeeValues();

    /**
     * Process the payment type fee
     * Cartão -> 7.36%
     * Boleto -> 1.45%
     */
    $payment_type_fee_percentage = $this->getPaymentTypeFeePercentage($data->payment_type, $fee_values['payment_type_fee']);
    $payment_fee = $origin_value * ($payment_type_fee_percentage / 100);

    /**
     * Process the exchange fee
     * Value < 3k -> 3% fee
     * value > 3k -> 1% fee
     */
    $exchangeFeePercentage = $this->getExchangeFeePercentage($origin_value, $fee_values['min_value_fee']);
    $exchangeFee = $origin_value * ($exchangeFeePercentage / 100);

    return [
      'paymentFee' => sprintf("%.2f", $payment_fee),
      'exchangeFee' => sprintf("%.2f", $exchangeFee),
    ];
  }

  protected function processNetValue(FetchDataData $data, array $feeValues): string
  {
    /** Returns the origin value formatted. 0,00 -> 0.00 */
    $origin_value = $data->formattedOriginValue();

    /** Processes the payment fee */
    $payment_fee_net_value = $this->processFee($origin_value, $feeValues['paymentFee']);

    /** Processes the exchange fee */
    $net_value = $this->processFee($payment_fee_net_value, $feeValues['exchangeFee']);

    return $net_value;
  }

  protected function processDestinyValue(string $net_value, $value): string
  {
    return sprintf("%.2f", $net_value * $value);
  }

  protected function getFeeValues(): array
  {
    $config =$this->configModel->whereName(ConfigName::FeePercentages)->get('value')->toArray()[0];
    
    return [
      'min_value_fee' => json_decode($config['value'], true)['min_value_fee'],
      'payment_type_fee' => json_decode($config['value'], true)['payment_type_fee'],
    ];
  }

  protected function getPaymentTypeFeePercentage(string $discount_type, array $payment_type_fee)
  {
    return match ($discount_type) {
      PaymentType::Cartao->value => $payment_type_fee['cartao'],
      PaymentType::Boleto->value => $payment_type_fee['boleto'],
    };
  }

  protected function getExchangeFeePercentage(string $value, array $min_value_fee): string
  {
    $discount_percentage = $min_value_fee['percentage'];

    if (doubleval($value) > $min_value_fee['min_value']) {
      $discount_percentage = 1;
    }

    return $discount_percentage;
  }

  protected function processFee(string $origin_value, string $fee): string
  {
    $netValue = $origin_value - $fee;

    return sprintf('%.2f', $netValue);
  }
}