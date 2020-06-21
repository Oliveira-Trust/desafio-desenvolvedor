<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\IBaseRepository;

interface IStatusRepository extends IBaseRepository
{
    public function getRefTables() : array;

    public function getDatatable();

    public function filterByRef(string $refTable, array $filter = []) : Collection;
}