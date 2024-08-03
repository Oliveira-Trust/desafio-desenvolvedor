<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\User\Actions\CreateUserAction;
use Domain\User\DataTransferObject\CreateUserData;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
	public function __construct(
		public readonly Response $response,
	) {
	}

	public function __invoke(
		Request $request,
		CreateUserAction $action,
	) {
		$data = CreateUserData::from($request->toArray());

		$response = $action->execute($data);

		return $this->response->json($response, 200);
	}
}