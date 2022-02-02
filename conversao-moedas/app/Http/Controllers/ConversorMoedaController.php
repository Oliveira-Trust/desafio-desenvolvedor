<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class ConversorMoedaController extends Controller
{
    public function converterMoeda(Request $request)
    {
        // return ApiService::converterMoeda('USD');
        return response()->json($request->all(), 200, [], JSON_NUMERIC_CHECK);
    }
}
