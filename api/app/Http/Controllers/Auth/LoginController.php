<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Auth\Actions\LoginAction;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\LaravelData\Attributes\Validation\Email;

class LoginController extends Controller
{
	public function __construct(
        public readonly Response $response,
    ) {
    }

	public function __invoke(
		Request $request,
		LoginAction $action,
	) {
		$validator = Validator::make(
			data: $request->toArray(),
			rules: [
              'email' => ['required', new Email()],
              'password' => ['required', 'string'],
			],
		);

		$data = $validator->validate();

		$response = $action->execute($data);

		return $this->response->json($response, 200);
	}
}