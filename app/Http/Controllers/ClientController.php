<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use App\Model\Client;
use App\Repository\Contracts\ClientRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ClientRepositoryInterface $clientRepository): JsonResponse
    {
        return response()->json($clientRepository->queryToPaginate($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientFormRequest $request): JsonResponse
    {
        try {
            Client::create($request->input());

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
    public function show(Client $client): JsonResponse
    {
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client): JsonResponse
    {
        try {
            $client->update($request->input());

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
    public function destroy(Client $client): JsonResponse
    {
        try {
            $client->delete();

            return response()->json([
                'message' => 'Registro deletado com sucesso.',
            ]);
        } catch (\PDOException $e) {
            Log::error($e->getMessage());
            
            return response()->json(['error' => 'Não foi possível deletar o registro.'], 500);
        }
    }
}
