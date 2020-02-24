<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PurchaseFilters extends QueryFilters
{

    /**
     * Filter by id.
     *
     * @param $id
     * @return Builder
     */
    public function id($id)
    {
        return $this->builder->where('id', $id);
    }

    /**
     * Filter by id.
     *
     * @param $status
     * @return Builder
     */
    public function status($status)
    {
        return $this->builder->where('status', $status);
    }

    /**
     * Filter by created_at.
     *
     * @param string $created_at
     * @return Builder
     */
    public function created_at($created_at)
    {
        return $this->builder->whereBetween('created_at', [$created_at . ' 00:00:00', $created_at . ' 23:59:59']);
    }

    /**
     * Filter by customer name.
     *
     * @param string $name
     * @return Builder
     */
    public function name($name)
    {
        return $this->builder->whereHas('customer', function ($query) use ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        });
    }

}
