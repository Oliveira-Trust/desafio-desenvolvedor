<?php

namespace App\Repository;

use App\Model\Purchase;
use App\Repository\Contracts\PurchaseRepositoryInterface;

/**
 * @method Purchase[] queryToPaginate()
 */
class PurchaseRepository extends AbstractRepository implements PurchaseRepositoryInterface
{
    public function __construct(Purchase $model)
    {
        $this->model = $model;
    }
}