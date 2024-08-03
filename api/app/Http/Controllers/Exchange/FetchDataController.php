<?php

namespace App\Http\Controllers\Exchange;

use Domain\Exchange\Actions\FetchDataAction;
use Domain\Exchange\DataTransferObject\FetchDataData;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * @author Diego Leandro - <https://github.com/diglean>
 */
class FetchDataController extends Controller
{
    public function __construct(
        private readonly Response $response
    ) {
    }

    public function __invoke(
        Request $request,
        FetchDataAction $action,
    ) {
        $data = FetchDataData::from($request->toArray());

        $response = $action->execute($data);

        return $this->response->json($response, 200);
    }
}
