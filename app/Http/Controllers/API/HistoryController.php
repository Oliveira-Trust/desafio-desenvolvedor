<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryCurrencyConversion;
use Illuminate\Support\Facades\Auth;
use App\Repository\HistoryRepositoryInterface;

class HistoryController extends Controller implements HistoryRepositoryInterface
{
    /**
     * @param Request $reques
     * @return Response
     */
    public function setHistory(Request $request)
    {
        try {
            $user = Auth::user();

            $success = HistoryCurrencyConversion::create([
                'moeda_origin' => $request->currency_origin,
                'moeda_destino' => $request->currency_destiny,
                'forma_pagamento' => $request->form_payment,
                'taxa_pagamento' => $request->tax_payment,
                'taxa_conversao' => $request->tax_conversion,
                'valor_conversao' => $request->value_conversion,
                'valor_com_taxa' => $request->value_with_tax,
                'valor_sem_taxa' => $request->value_without_tax,
                'valor_convertido' => $request->value_bidden,
                'user_id' => $user->id
            ]);

            $message = 'Usuário registrado com sucesso!';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * @param null
     * @return Response
     */
    public function getHistory()
    {
        try {
            $user = Auth::user();
            $message = HistoryCurrencyConversion::where('user_id', $user->id)->orderBy('id', 'desc')->get();
            $success = true;
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}
