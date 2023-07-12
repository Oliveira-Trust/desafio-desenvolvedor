<?php

namespace App\Services\User;

interface UserServiceContract
{
    public function getById(int $id);
    public function all();
    public function getByAttribute(string $field, string $attribute);
    public function store(array $data);
    public function updateById(array $data, int $id);
    public function delete(int $id);
    public function login(array $credentials);
    public function logout();
}
