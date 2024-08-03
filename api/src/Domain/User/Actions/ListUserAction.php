<?php

namespace Domain\User\Actions;

use Domain\User\Models\Users;
use Illuminate\Pagination\LengthAwarePaginator;

class ListUserAction
{
	public function __construct(
		public Users $usersModel,
	) {
	}

	public function execute(array $data): array
	{
		$usersQuery = $this->usersModel;

		if ( isset($data['user_id'])) {
			$users = $usersQuery->whereId($data['user_id'])->with('tasks')->get();
		} else {
			$users = $usersQuery->get(['id', 'name']);
		}

        $users = ['users' => $users];

        if (
          isset($data['page']) &&
          $data['page'] !== '' &&
          ! is_null($data['page'])
        ) {
          $users['paginatedUsers'] = $this->getPaginatedUsers($data['search'] ?? null);
        }

		return $users;
	}

    private function getPaginatedUsers(?string $search = null): LengthAwarePaginator
    {
      $paginatedUsers = $this->usersModel;

      if ($search) {
        $paginatedUsers->where('name', 'LIKE', "%{$search}%");
      }

      return $paginatedUsers->paginate(5);
    }
}