<?php

namespace App\Services;

use App\Models\Instrument;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class InstrumentService
{
    public function list(Request $request): LengthAwarePaginator
    {
        $query = Instrument::query();

        if ($ticker = $request->query('TckrSymb')) {
            $query->where('TckrSymb', $ticker);
        }

        if ($date = $request->query('RptDt')) {
            $query->where('RptDt', $date);
        }

        return $query
            ->select(['RptDt', 'TckrSymb', 'MktNm', 'SctyCtgyNm', 'ISIN', 'CrpnNm'])
            ->paginate(20);
    }
}
