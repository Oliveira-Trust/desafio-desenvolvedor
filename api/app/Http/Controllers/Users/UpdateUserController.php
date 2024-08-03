<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\User\Actions\UpdateUserAction;
use Domain\User\DataTransferObject\UpdateUserData;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
	public function __construct(
		public readonly Response $response,
	) {
	}

	public function __invoke(
		Request $request,
		UpdateUserAction $action,
	) {
		$data = UpdateUserData::from($request->toArray());

		$response = $action->execute($data);

		return $this->response->json($response, 200);
	}
}