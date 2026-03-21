<?php

namespace App\Domains\MarketData\Application\Services;

use App\Domains\MarketData\Infrastructure\Persistence\Eloquent\MarketData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

final class MarketDataService
{
    public function search(?string $ticker = null, ?string $reportDate = null, ?int $perPage = null): Collection|LengthAwarePaginator
    {
        $query = MarketData::query()
            ->select([
                'rpt_dt',
                'tckr_symb',
                'mkt_nm',
                'scty_ctgy_nm',
                'isin',
                'crpn_nm',
            ])
            ->when($ticker !== null, fn ($builder) => $builder->where('tckr_symb', $ticker))
            ->when($reportDate !== null, fn ($builder) => $builder->whereDate('rpt_dt', $reportDate))
            ->orderBy('rpt_dt', 'desc')
            ->orderBy('tckr_symb');

        if ($ticker === null && $reportDate === null) {
            return $query->paginate($perPage ?? 10);
        }

        return $query->get();
    }
}
