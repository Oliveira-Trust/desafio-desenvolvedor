<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Interface\User\UserInterface;

class UserRepository implements UserInterface
{

    public function getUserById(int $id)
    {
        return User::find($id);
    }

    public function getUserConfigTax(int $id, string $method)
    {
        $user = User::with(['conversionRatesConfiguration' => function ($query) use ($method) {
                $query->where('payment_method', $method);
        }])->find($id);

        return $user;
    }

    public function updateUserConfigTax(int $id, array $data)
    {
        $user = User::find($id);
        $user->configTax = $data;
        $user->save();
        return $user;
    }

}