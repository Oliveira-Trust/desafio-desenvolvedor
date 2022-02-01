<?php

namespace App\Api\Currencies\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\Currencies\Actions\MapAvailablesCurrencies;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function availables(
        Request $request,
        MapAvailablesCurrencies $mapAvailablesCurrencies
    ): \Illuminate\Http\JsonResponse
    {
        $response = $mapAvailablesCurrencies();
        return response()->json($response);
    }
}
