<?php

namespace Domain\User\Actions;

use Domain\User\DataTransferObject\CreateUserData;
use Domain\User\Models\Users;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
	public function __construct(
		public Users $usersModel,
	) {
	}

	public function execute(CreateUserData $data)
	{
        $randomPhoto = fake()->regexify('/[0-9]{8}/');

		$createdUser = $this->usersModel->create([
			'name' => "{$data->firstName} {$data->lastName}",
			'email' => $data->email,
			'password' => Hash::make($data->password),
			'profile_picture_url' => "https://avatars.githubusercontent.com/u/{$randomPhoto}?v=4",
		]);

		return [
			'id' => $createdUser->id,
		];
	}
}