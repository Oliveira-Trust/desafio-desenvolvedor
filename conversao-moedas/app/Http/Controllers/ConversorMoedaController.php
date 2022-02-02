<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Http\Requests\ConversaoMoedaRequest;

class ConversorMoedaController extends Controller
{
    public function converterMoeda(ConversaoMoedaRequest $request)
    {
        // return ApiService::converterMoeda('USD');
        return response()->json($request->all(), 200, [], JSON_NUMERIC_CHECK);
    }
}
