<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArquivoRequest;
use App\Services\ArquivoService;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function __construct(private readonly ArquivoService $arquivoService)
    {}

    public function upload(ArquivoRequest $request): JsonResponse
    {
        $arquivo = $request->file('file');
        $arquivoJaFoiEnviado = $this->arquivoService->verificaSeJaFoiEnviado($arquivo);

        if ($arquivoJaFoiEnviado) {
            return response()->json(['message' => 'Arquivo já enviado anteriormente'], 400);
        }

        $response = $this->arquivoService->uploadArquivo($arquivo);
        return response()->json(['message' => $response]);
    }
}
