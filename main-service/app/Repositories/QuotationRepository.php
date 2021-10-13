<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Quotation;
use App\Repositories\Contracts\QuotationRepositoryInterface;

class QuotationRepository extends BaseRepository implements QuotationRepositoryInterface
{
    public function model() : string
    {
        return Quotation::class;
    }
}
