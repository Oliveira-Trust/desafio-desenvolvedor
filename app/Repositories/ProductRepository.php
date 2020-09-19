<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }
}
