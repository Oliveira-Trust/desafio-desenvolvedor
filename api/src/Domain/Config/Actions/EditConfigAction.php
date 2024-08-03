<?php

namespace Domain\Config\Actions;

use Domain\Config\DataTransferObject\EditConfigData;
use Domain\Config\Enums\ConfigName;
use Domain\Config\Models\Config;

class EditConfigAction
{
  public function __construct(
    public readonly Config $configModel,
  ) {
  }

  public function execute(EditConfigData $data): void
  {
    $this->configModel->whereName(ConfigName::FeePercentages)->update([
      'value' => json_encode([
        'min_value_fee' => [
          'min_value' => $data->min_value_exchange,
          'percentage' => $data->min_value_exchange_fee
        ],
        'payment_type_fee' => [
          'cartao' => $data->card_payment_fee,
          'boleto' => $data->ticket_payment_fee,
        ],
      ]),
    ]);

    $this->configModel->whereName(ConfigName::CompanyEmailAddress)->update([
      'value' => $data->company_email_address,
    ]);
  }
}