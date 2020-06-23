<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\IBaseRepository;

interface IOrderRepository extends IBaseRepository
{
    public function getOrderStatuses() : array;

    public function getDatatable();
}