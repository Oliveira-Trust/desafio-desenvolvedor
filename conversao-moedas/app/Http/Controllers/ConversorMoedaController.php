<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class ConversorMoedaController extends Controller
{
    public function converterMoeda()
    {
        return ApiService::converterMoeda('USD');
    }
}
