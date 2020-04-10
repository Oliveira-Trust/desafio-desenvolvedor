<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}