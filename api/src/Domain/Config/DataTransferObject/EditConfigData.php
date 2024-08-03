<?php

namespace Domain\Config\DataTransferObject;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

class EditConfigData extends Data
{
  public function __construct (
    public readonly string $card_payment_fee,
    public readonly string $ticket_payment_fee,
    public readonly string $min_value_exchange,
    public readonly string $min_value_exchange_fee,
    public readonly string $company_email_address,
  ) {
  }

  public function rules(): array
  {
    return [
      'card_payment_fee' => ['required', 'string'],
      'ticket_payment_fee' => ['required', 'string'],
      'min_value_exchange' => ['required', 'string'],
      'min_value_exchange_fee' => ['required', 'string'],
      'company_email_address' => ['required', new Email()]
    ];
  }
}