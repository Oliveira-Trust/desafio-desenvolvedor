<?php

namespace App\Repository\Contracts;

interface ClientRepositoryInterface
{
    public function queryToPaginate(array $params);
}