<?php

namespace App\Repositories\Interfaces;

use App\Response\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface iBaseRepository
{
    public function all() : Collection;

    public function getById(string $uuid) : Model;

    public function create(array $attr) : JsonResponse;

    public function update(string $uuid, array $attr) : JsonResponse;

    public function delete(string $uuid) : JsonResponse;
}