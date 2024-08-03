<?php

namespace App\Http\Controllers\Exchange;

use Domain\Exchange\Actions\FetchDataAction;
use Domain\Exchange\Actions\GetExchangeUserAction;
use Domain\Exchange\DataTransferObject\FetchDataData;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class GetExchangeUserController extends Controller
{
  public function __construct(
    private readonly Response $response
  ) {
  }

  public function __invoke(
    Request $request,
    GetExchangeUserAction $action,
  ) {
      $validator = Validator::make(
        data: $request->toArray(),
        rules: ['user_id' => ['required', 'int', 'min:1']]
      );

      $data = $validator->validate();

      $response = $action->execute($data['user_id']);

      return $this->response->json($response, 200);
  }
}