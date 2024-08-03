<?php

namespace Domain\User\Actions;

use Domain\User\DataTransferObject\UpdateUserData;
use Domain\User\Enums\UserType;
use Domain\User\Models\Users;
use Illuminate\Support\Carbon;

class UpdateUserAction
{
	public function __construct(
		public Users $usersModel,
	) {
	}

	public function execute(UpdateUserData $data)
	{
		$this->usersModel
          ->find($data->id)
          ->update([
			'name' => $data->name,
			'email' => $data->email,
            'birth_date' => $data->birth_date,
			'type' => UserType::Regular,
            'updated_at' => Carbon::now(),
		  ]);

        $user = $this->usersModel->find($data->id);

		return ['user' => $user];
	}
}