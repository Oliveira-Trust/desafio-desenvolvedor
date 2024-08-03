<?php

namespace Domain\Marketing\Email\Actions;

use App\Library\Format;
use Domain\Exchange\Models\ExchangeUsers;
use Domain\Marketing\Email\DataTransferObject\TransactionalEmailData;
use Illuminate\Support\Carbon;

class GetTransactionalEmailDataAction
{
  public function __construct(
    public readonly ExchangeUsers $exchangeUsersModel,
  ) {
  }

  public function execute(TransactionalEmailData $data): array
  {
    // I did this because I can implement other transaction_type later
    if ($data->type === 'purchase_concluded') {
      $transaction_data = $this->getPurchaseConcludedData($data);
    }

    return $transaction_data;
  }

  protected function getPurchaseConcludedData(TransactionalEmailData $data): array
  {
    $transaction_data = $this->exchangeUsersModel->find($data->data_id)->toArray();
    $transaction_data['subject'] = 'Seu recibo de compra';

    $format = new Format();

    $transaction_data['data'] = json_decode($transaction_data['exchange_data'], true);
    $transaction_data['data'] = $format->formatPurchaseData([$transaction_data['data']])[0];

    $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $transaction_data['created_at']);
    
    $transaction_data['data']['date'] = $datetime->format('d/m/Y');
    $transaction_data['data']['time'] = $datetime->format('H:i');

    return $transaction_data;
  }
}