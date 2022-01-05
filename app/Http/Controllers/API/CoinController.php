<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Repository\CoinRepositoryInterface;

class CoinController extends Controller implements CoinRepositoryInterface
{
    /**
     * Coins
     */
    public function getCoins()
    {
        try {
            $success = Http::get('https://economia.awesomeapi.com.br/json/available/uniq')
                ->json();
            $message = "Successfully";
        } catch (\Exception $e) {
            $success = false;
            $message = $e;
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

    /**
     * convert
     */
    public function convert(Request $request)
    {
        try {
            $from = $request->from;
            $to = $request->to;
            $http = Http::get('https://economia.awesomeapi.com.br/json/last/' . $from . '-' . $to);

            if ($http->status() === 200) {
                $success = true;
                $message = $http->json();
            } else {
                $success = false;
                $message = "Não foi achado a moeda " . $from . '-' . $to;
            }
        } catch (\Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }
}
