<?php

namespace Domain\Config\Actions;

use Domain\Config\DataTransferObject\EditConfigData;
use Domain\Config\Enums\ConfigName;
use Domain\Config\Models\Config;

class GetConfigAction
{
  public function __construct(
    public readonly Config $configModel,
  ) {
  }

  public function execute(): array
  {
    $fee_values = $this->configModel
      ->whereName(ConfigName::FeePercentages)
      ->get('value')
      ->toArray()[0]['value'];

    $fee_values = json_decode($fee_values, true);

    $company_email_address = $this->configModel
      ->whereName(ConfigName::CompanyEmailAddress)
      ->get('value')
      ->toArray()[0]['value'];

    return [
      'fee_values' => $fee_values,
      'company_email_address' => $company_email_address
    ];
  }
}