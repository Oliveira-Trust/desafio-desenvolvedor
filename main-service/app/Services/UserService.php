<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(int $id) : Model
    {
        return $this->userRepository->findById($id);
    }

    public function storeNewUser(array $data) : User
    {
        return $this->userRepository->store($data);
    }

    public function updateSingleField(int $id, string $field, $value): void
    {
        $this->userRepository->updateSingle($id, $field, $value);
    }

    public function setNewPassword(string $email) : array
    {
        $user = $this->userRepository
                      ->selectFields('id', 'name', 'email')
                      ->findWhereFirst('email', $email);

        if (!$user) {
            throw new \Exception('O email informado não está cadastrado no sistema.');
        }

        $newPass = $user['id'].'_trocar_senha';
        $this->updateSingleField($user->id, 'password', $newPass);

        return [
            "user_name" => $user->name,
            "user_email" => $user->email,
            "user_password" => $newPass
        ];
    }
}
