<?php

namespace App\Repository\Contracts;

interface PurchaseRepositoryInterface
{
    public function queryToPaginate(array $params);
}