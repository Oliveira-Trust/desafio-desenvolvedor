<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\User\Actions\ListUserAction;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListUserController extends Controller
{
	public function __construct(
		public readonly Response $response,
	) {
	}

	public function __invoke(
		Request $request,
		ListUserAction $action,
	) {
		$validator = Validator::make(
			data: $request->toArray(),
			rules: [
                'page' => ['nullable', 'integer', 'min:1'],
				'user_id' => ['nullable', 'integer', 'min:1'],
			],
		);

		$data = $validator->validate();

		$response = $action->execute($data);

		return $this->response->json($response, 200);
	}
}