<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Expression;

class PageableRegistryBookCriteria extends AbstractCriteria
{
    public function applyToQuery($model)
    {
        return $model->orderByRaw('length(book_volume_complement) desc')
            ->orderBy('book_volume_complement', 'desc')
            ->orderBy('book_volume', 'desc')
            ->orderBy('book_page_begin', 'desc');
    }
}
