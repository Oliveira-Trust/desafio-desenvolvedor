<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository implements IUserRepository
{
    /**
     * Return all users
     *
     * @return Collection
     */
    public function all() : Collection
    {
        return User::all();
    }

    /**
     * Get user by UUID
     *
     * @param string $uuid
     * @return User
     */
    public function getById(string $uuid) : User
    {
        return User::findByUuid($uuid);
    }

    /**
     * Create a new user instance
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $attr) : User
    {
        $newUser = User::create([
            'name' => $attr['name'],
            'email' => $attr['email'],
            'password' => Hash::make($attr['password'])
        ]);
        
        return $this->generateToken($newUser->getUuid());
    }

    /**
     * Update a user instance
     *
     * @param  string  $uuid
     * @param  array  $data
     * @return \App\Models\User
     */
    public function update(string $uuid, array $attr) : User
    {
        User::where('uuid', $uuid)
            ->update($attr);
        
        return $this->getById($uuid);
    }

    /**
     * Create API Token from user
     *
     * @param string $uuid
     * @return User
     */
    public function generateToken(string $uuid) : User
    {
        User::where('uuid', $uuid)
            ->update([
            'api_token' => Str::random(60)
            ]);

        return $this->getById($uuid);
    }
}