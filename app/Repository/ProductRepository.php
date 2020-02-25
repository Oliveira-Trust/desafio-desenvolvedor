<?php

namespace App\Repository;

use App\Model\Product;
use App\Repository\Contracts\ProductRepositoryInterface;

/**
 * @method Product[] queryToPaginate()
 */
class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}