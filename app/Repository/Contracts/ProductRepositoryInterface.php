<?php

namespace App\Repository\Contracts;

interface ProductRepositoryInterface
{
    public function queryToPaginate(array $params);
}