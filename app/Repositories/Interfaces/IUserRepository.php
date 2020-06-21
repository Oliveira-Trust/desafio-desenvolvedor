<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{
    public function all() : Collection;

    public function getById(string $uuid) : User;

    public function create(array $attr) : User;

    public function update(string $uuid, array $attr) : User;

    public function generateToken(string $uuid) : User;
}