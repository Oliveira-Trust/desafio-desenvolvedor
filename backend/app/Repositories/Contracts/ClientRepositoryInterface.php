<?php

namespace App\Repositories\Contracts;

interface ClientRepositoryInterface
{
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}