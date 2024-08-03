<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use Domain\Config\Actions\EditConfigAction;
use Domain\Config\DataTransferObject\EditConfigData;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;

class EditConfigController extends Controller
{
  public function __construct(
    public readonly Response $response,
  ) {
  }

  public function __invoke(
    Request $request,
    EditConfigAction $action,
  ) {
    $data = EditConfigData::from($request->toArray());

    $action->execute($data);

    $this->response->json([], 200);
  }
}