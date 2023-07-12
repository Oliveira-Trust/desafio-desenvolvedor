<?php

namespace App\Repositories\CurrencyConversion;

use App\Repositories\BaseRepositoryContract;

interface CurrencyConversionRepositoryContract extends BaseRepositoryContract
{

    public function getById(int $id);
    public function all();
    public function getByAttribute(string $field, string $attribute);
    public function store(array $data);
    public function updateById(array $data, int $id);
    public function delete(int $id);
    public function getByUserId(int $userId, int $perPage, string $orderBy, string $orderDirection);
}
