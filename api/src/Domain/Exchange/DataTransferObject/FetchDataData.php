<?php

namespace Domain\Exchange\DataTransferObject;

use Domain\Currency\CurrencyType;
use Domain\Payment\PaymentType;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Data;

class FetchDataData extends Data
{
    public function __construct(
        public readonly string $origin_currency,
        public readonly string $destiny_currency,
        public readonly string $origin_value,
        public readonly string $payment_type,
        public readonly ?int $user_id,
    ) {
    }

    public function rules(): array
    {
        return [
          'origin_currency' => ['required', new Enum(CurrencyType::class)],
          'destiny_currency' => ['required', new Enum(CurrencyType::class)],
          'origin_value' => ['required', 'string'],
          'payment_type' => ['required', new Enum(PaymentType::class)],
          'user_id' => ['nullable', 'int', 'min:1'],
        ];
    }

    public function formattedOriginValue(): string
    {
      $totalValue = str_replace('.', '', $this->origin_value);
      $totalValue = str_replace(',', '.', $totalValue);

      return $totalValue;
    }
}
