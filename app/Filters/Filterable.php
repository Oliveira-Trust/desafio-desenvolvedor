<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable {

    /**
     * Filter a result set.
     *
     * @param  Builder      $query
     * @param  QueryFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, QueryFilters $filters) {
        return $filters->apply($query);
    }

}
