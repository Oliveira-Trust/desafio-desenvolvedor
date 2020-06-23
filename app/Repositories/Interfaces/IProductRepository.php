<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\IBaseRepository;

interface IProductRepository extends IBaseRepository
{
    public function getProductImages() : array;

    public function getProductStatuses() : array;

    public function getDatatable();
}