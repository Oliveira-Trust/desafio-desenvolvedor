<?php

declare(strict_types=1);

namespace App\Instrument\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface InstrumentRepositoryInterface extends BaseRepositoryInterface
{
    public function searchInstruments(?string $tckrSymb, ?string $rptDt): LengthAwarePaginator|Collection;
}
