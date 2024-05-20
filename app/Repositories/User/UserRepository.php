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

    public function update(int $id, array $data)
    {
        $user = User::find($id);
        $user->fill($data);
        $user->save();
        return $user;
    }

    public function getUserConfigTax(int $id, string $method)
    {
        $user = User::with(['conversionRatesConfiguration' => function ($query) use ($method) {
                $query->where('payment_method', $method);
        }])->find($id);

        return $user;
    }

    public function getHistoricalQuotesByUserId(string $userId): array
    {
        $user = User::find($userId);
        return $user->quotes;
    }

    public function updateUserConfigTax(int $id, array $configs)
    {
        $user = User::find($id);
        $user->conversionRatesConfiguration()->delete();
        foreach ($configs as $config) {
            $user->conversionRatesConfiguration()->create($config);
        }

        return $user;
    }

}