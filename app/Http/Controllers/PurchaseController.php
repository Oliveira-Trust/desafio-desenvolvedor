<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseFormRequest;
use App\Http\Resources\PurchaseResource;
use App\Model\Purchase;
use App\Repository\Contracts\PurchaseRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PurchaseRepositoryInterface $purchaseRepository): JsonResponse
    {
        return response()->json($purchaseRepository->queryToPaginate($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseFormRequest $request): JsonResponse
    {
        try {
            Purchase::create([
                'client_id' => $request->input('client_id'),
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity'),
                'status' => 'PENDING'
            ]);

            return response()->json([
                'message' => 'Registro criado com sucesso.'
            ]);
        } catch (\PDOException $e) {
            Log::error($e->getMessage());

            return response()->json(['error' => 'Não foi possível criar o registro.'], 500); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase): JsonResponse
    {
        return response()->json(new PurchaseResource($purchase));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase): JsonResponse
    {
        try {
            $purchase->update($request->input());

            return response()->json([
                'message' => 'Registro atualizado com sucesso.',
            ]);
        } catch (\PDOException $e) {
            Log::error($e->getMessage());
            
            return response()->json(['error' => 'Não foi possível atualizar o registro.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase): JsonResponse
    {
        try {
            $purchase->delete();

            return response()->json([
                'message' => 'Registro deletado com sucesso.',
            ]);
        } catch (\PDOException $e) {
            Log::error($e->getMessage());
            
            return response()->json(['error' => 'Não foi possível deletar o registro.'], 500);
        }
    }
}
