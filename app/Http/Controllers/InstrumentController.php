<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstrumentController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'TckrSymb' => ['sometimes', 'nullable', 'string', 'max:20'],
            'RptDt' => ['sometimes', 'nullable', 'date_format:Y-m-d']
        ]);

        $ticker = $request->filled('TckrSymb') ? strtoupper(trim($request->input('TckrSymb'))) : null;
        $date = $request->filled('RptDt') ? $request->input('RptDt') : null;
        $perPage = 15;

        $instruments = null;

        if ($ticker || $date) {
            $query = Instrument::query();

            if ($ticker) {
                $query->byTicker($ticker);
            }
            if ($date) {
                $query->byDate($date);
            }

            $instruments = $query
                ->orderBy('RptDt', 'desc')
                ->orderBy('TckrSymb')
                ->paginate($perPage)
                ->withQueryString();
        }

        return view('instruments.index', compact('instruments', 'ticker', 'date'));
    }
}
