<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Taxa;
use App\Http\Requests\TaxasRequest;

class TaxasController extends Controller
{
    public function index()
    {
        $taxas = Taxa::all(); // Recupera todas as taxas da tabela

        return view('taxas.index', compact('taxas'));
    }

    public function salvarTaxasEditadas(TaxasRequest $request)
    {
        try {
            // Atualiza as taxas na tabela taxas
            DB::table('taxas')->where('TAXA', 'BO')->update(['VALOR' => $request->boleto]);
            DB::table('taxas')->where('TAXA', 'CC')->update(['VALOR' => $request->cartao_credito]);
            DB::table('taxas')->where('TAXA', 'CMA')->update(['VALOR' => $request->conversao_maior_3000]);
            DB::table('taxas')->where('TAXA', 'CME')->update(['VALOR' => $request->conversao_menor_3000]);

            return response()->json(['message' => 'Taxas atualizadas com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar as taxas'], 500);
        }
    }
}
