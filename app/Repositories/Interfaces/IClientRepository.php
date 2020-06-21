<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\IBaseRepository;

interface IClientRepository extends IBaseRepository
{
    public function getClientStatuses() : array;

    public function getDatatable();
}