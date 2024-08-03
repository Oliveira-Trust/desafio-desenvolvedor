<?php

namespace Domain\Auth\Actions;

use App\Library\Jwt;
use Domain\User\Models\Users;

class LoginAction
{
	public function __construct(
		public Users $usersModel,
	) {
	}

	public function execute(array $data)
	{
		$user = $this->usersModel->whereEmail($data['email'])->first();

		if ( ! $user) {
			throw new \DomainException('Not authorized');
		}

		if ( ! password_verify($data['password'], $user->password)) {
			throw new \DomainException('Not authorized');
		}

		$token = Jwt::create($user);

		return [
          'token' => $token,
          'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'profile_picture' => $user->profile_picture_url,
            'type' => $user->type,
          ],
		];
	}
}