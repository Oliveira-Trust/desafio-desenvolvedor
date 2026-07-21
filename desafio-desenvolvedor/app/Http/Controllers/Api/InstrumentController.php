<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Http\Resources\InstrumentResource;
use Illuminate\Support\Facades\Cache;

class InstrumentController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'TckrSymb' => 'sometimes|string',
            'RptDt' => 'sometimes|date_format:Y-m-d',
        ]);

        $page = $request->get('page', 1);
        $filters = $request->only(['TckrSymb', 'RptDt']);
        $cacheKey = 'instruments_search_' . md5(json_encode($filters) . "_p$page");

        // busca com cache por 10 minutos / 600 segundos
        $instruments = Cache::remember($cacheKey, 600, function () use ($request) {
            $query = Instrument::query();

            // filtro por TckrSymb
            $query->when($request->filled('TckrSymb'), function ($q) use ($request) {
                return $q->where('tckr_symb', $request->TckrSymb);
            });

            // filtro por RptDt
            $query->when($request->filled('RptDt'), function ($q) use ($request) {
                return $q->where('rpt_dt', $request->RptDt);
            });

            $query->orderBy('rpt_dt', 'desc');

            return $query->paginate(15);
        });

        return InstrumentResource::collection($instruments);
    }
}
