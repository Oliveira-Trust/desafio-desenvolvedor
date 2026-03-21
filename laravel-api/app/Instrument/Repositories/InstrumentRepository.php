<?php

declare(strict_types=1);

namespace App\Instrument\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Instrument\Interfaces\InstrumentRepositoryInterface;
use App\Instrument\Models\Instrument;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class InstrumentRepository extends BaseRepository implements InstrumentRepositoryInterface
{
    protected string $model = Instrument::class;

    public function searchInstruments(?string $tckrSymb, ?string $rptDt): LengthAwarePaginator|Collection
    {
        $query = $this->model::query()
            ->select(['RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm'])
            ->when($tckrSymb, fn ($q, $v) => $q->where('TckrSymb', $v))
            ->when($rptDt, fn ($q, $v) => $q->whereDate('RptDt', $v));

        return ($tckrSymb || $rptDt)
            ? $query->get()
            : $query->paginate(50);
    }
}
