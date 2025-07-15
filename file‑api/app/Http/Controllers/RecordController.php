<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Resources\RecordResource;
use App\Models\Record;
use Illuminate\Support\Facades\Cache;

class RecordController extends Controller
{
    public function index(SearchRequest $request)
    {
        $query = Record::query();

        // ➜ filtros opcionais
        if ($request->filled('TckrSymb')) {
            $query->where('TckrSymb', $request->input('TckrSymb'));
        }

        if ($request->filled('RptDt')) {
            // Para MongoDB você pode usar ->where('RptDt', $request->input('RptDt'))
            $query->whereDate('RptDt', $request->input('RptDt'));
        }

        // ➜ paginate(15) com cache de 5 min quando **nenhum** filtro é enviado
        $page     = $request->query('page', 1);
        $hasFilter = $request->filled('TckrSymb') || $request->filled('RptDt');

        $records = $hasFilter
            ? $query->paginate(15)
            : Cache::remember("records_page_{$page}", now()->addMinutes(5), fn () => $query->paginate(15));

        return RecordResource::collection($records);
    }
}
