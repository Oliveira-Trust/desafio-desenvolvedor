<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArquivoRequest;
use App\Http\Resources\ArquivosResource;
use App\Models\Arquivo;
use App\Models\ArquivoConteudo;
use App\Services\ArquivoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct(private readonly ArquivoService $arquivoService)
    {}

    public function arquivos()
    {
        $arquivos = Arquivo::paginate();
        return response()->json($arquivos);
    }

    public function conteudo(Request $request, $idArquivo)
    {
        $conteudo = ArquivoConteudo::query()
            ->where('arquivo_id', '=', $idArquivo);

        if ($request->has('termo') && $request->has('tipo')) {
            $termo = $request->get('termo');
            $tipo = $request->get('tipo');

            if ($tipo === 'TckrSymb') {
                $conteudo->where('TckrSymb', 'LIKE', "%{$termo}%");
            }

            if ($tipo === 'RptDt') {
                $conteudo->where('RptDt', '=', $termo);
            }

            return ArquivosResource::collection($conteudo->get());
        }

        // Se não houver filtros, realiza a paginação
        $conteudo = $conteudo->paginate();

        return ArquivosResource::collection($conteudo);
    }

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
