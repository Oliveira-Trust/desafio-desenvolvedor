<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Domain\Marketing\Email\Actions\EmailSenderAction;
use Domain\Marketing\Email\Actions\GetTransactionalEmailDataAction;
use Domain\Marketing\Email\DataTransferObject\TransactionalEmailData;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;

class SendTransactionalEmailController extends Controller
{
  public function __construct(
    public readonly Response $response,
    public readonly GetTransactionalEmailDataAction $getTransactionalEmailDataAction
  ) {
  }

  public function __invoke(
    Request $request,
    EmailSenderAction $emailSenderAction
  ) {
    $data = TransactionalEmailData::from($request->toArray());

    $email_data = $this->getTransactionalEmailDataAction->execute($data);

    $emailSenderAction->execute(
      $data->user_id,
      $email_data['subject'],
      $email_data['data'],
    );

    return $this->response->json(['msg' => 'Email enviado com sucesso!'], 200);
  }
}