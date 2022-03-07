<?php

namespace App\Repositories\Contracts;

interface CurrencyRepositoryInterface
{
    public function all();
    public function store(array $data);
}