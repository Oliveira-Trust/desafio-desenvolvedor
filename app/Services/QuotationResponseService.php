<?php

namespace App\Services;

use App\Dtos\QuotationResponseDto;
use Illuminate\Support\Collection;

class QuotationResponseService
{
    public function convertToCollection(array $data): Collection
    {
        return collect($data)->map(function ($item) {
            return new QuotationResponseDto($item);
        });
    }
}
