<?php

namespace App\Http\Controllers\Web;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

trait ManualPaginator
{
    /**
     * @param $data
     * @param $total
     * @param int $perPage
     * @param $page
     * @param array $options
     * @return Paginator
     */
    protected function paginate($data, int $total ,int $perPage, int $page, array $options = [])
    {
        return new Paginator($data, $total, 5, $page ?? 1, $options);
    }
}