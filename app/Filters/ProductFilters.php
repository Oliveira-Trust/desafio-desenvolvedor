<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilters extends QueryFilters
{

    /**
     * Filter by name.
     *
     * @param  string $name
     * @return Builder
     */
    public function name($name)
    {
        return $this->builder->where('name','like', '%'.$name.'%');
    }

    /**
     * @param $price
     * @return Builder
     */
    public function price($price)
    {
        return $this->builder->whereBetween('price', [1, 10]);
    }

}
