<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}