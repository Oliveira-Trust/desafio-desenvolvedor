<?php

namespace Domain\Exchange\Actions;

use App\Library\Format;
use Domain\Exchange\Models\ExchangeUsers;
use Domain\Marketing\Email\Actions\EmailSenderAction;
use Illuminate\Support\Carbon;

class CreateExchangeUsersAction
{
  public function __construct(
    private readonly ExchangeUsers $exchangeUsersModel,
    private readonly EmailSenderAction $emailSenderAction,
  ) {
  }

  public function execute(int $userId, array $exchange_data): int
  {
    $exchangeUser = $this->exchangeUsersModel->create([
      'user_id' => $userId,
      'created_at' => Carbon::now(),
      'exchange_data' => json_encode($exchange_data),
    ]);

    $format = new Format();

    $data = $format->formatPurchaseData([$exchange_data]);
    
    $data[0]['date'] = $exchangeUser->created_at->format('d/m/Y');
    $data[0]['time'] = $exchangeUser->created_at->format('H:i');

    $this->emailSenderAction->execute(
      user_id: $userId,
      subject: 'Compra efetuada com sucesso!',
      data: $data[0]
    );

    return $exchangeUser->id;
  }
}