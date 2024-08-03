<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use Domain\Config\Actions\GetConfigAction;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;

class GetConfigDataController extends Controller
{
  public function __construct(
    public readonly Response $response,
  ) {
  }

  public function __invoke(
    Request $request,
    GetConfigAction $action,
  ) {
    $response = $action->execute();

    return $this->response->json($response, 200);
  }
}