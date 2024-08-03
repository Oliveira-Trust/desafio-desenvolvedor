<?php

namespace Domain\Exchange\Actions;

use App\Library\Format;
use Domain\Exchange\Models\ExchangeUsers;
use Illuminate\Support\Carbon;

class GetExchangeUserAction
{
  public function __construct(
    public readonly ExchangeUsers $exchangeUsersModel,
  ) {
  }

  public function execute(int $user_id): array
  {
    $exchange_users = $this->exchangeUsersModel->whereUserId($user_id)->get()->toArray();

    return $this->formatPurchases($exchange_users);
  }

  protected function formatPurchases(array $data): array
  {
    $formatted_data = [];

    $format = new Format();

    foreach ($data as $key => $value) {
      $formatted_data[$key] = json_decode($value['exchange_data'], true);
      // $formatted_data[$key]['id'] = $value['id'];
      $formatted_data[$key]['created_at'] = $value['created_at'];
    }

    return $format->formatPurchaseData($formatted_data);
  }
}