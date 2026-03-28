<?php

namespace App\Http\Controllers;

use App\Services\InstrumentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function __construct(private InstrumentService $instrumentService) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->instrumentService->list($request));
    }
}
