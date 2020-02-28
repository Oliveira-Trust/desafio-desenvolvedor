<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Model\Product;
use App\Repository\Contracts\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductRepositoryInterface $productRepository): JsonResponse
    {
        return response()->json($productRepository->queryToPaginate($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request): JsonResponse
    {
        try {
            Product::create([
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'tag' => json_encode($request->input('tag'))
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
    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        try {
            $product->update($request->input());

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
    public function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete();

            return response()->json([
                'message' => 'Registro deletado com sucesso.',
            ]);
        } catch (\PDOException $e) {
            Log::error($e->getMessage());
            
            return response()->json(['error' => 'Não foi possível deletar o registro.'], 500);
        }
    }
}
