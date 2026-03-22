<?php

declare(strict_types=1);

namespace App\Instrument\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\Instrument\Services\InstrumentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function __construct(private InstrumentService $service) {}

    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'TckrSymb' => ['nullable', 'string', 'max:20'],
            'RptDt' => ['nullable', 'date_format:Y-m-d'],
        ]);

        $data = $this->service->search(
            tckrSymb: $request->TckrSymb,
            rptDt: $request->RptDt,
        );

        return response()->json($data);
    }
}
