<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArquivoRequest;
use App\Http\Resources\ArquivosResource;
use App\Models\Arquivo;
use App\Models\ArquivoConteudo;
use App\Models\HistoricoArquivo;
use App\Services\ArquivoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;

class ApiController extends Controller
{
    public function __construct(private readonly ArquivoService $arquivoService)
    {
    }

    public function arquivos(): JsonResponse
    {
        $arquivos = Arquivo::query()->paginate();
        return response()->json($arquivos);
    }

    public function conteudo(Request $request, $idArquivo): AnonymousResourceCollection
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

        $conteudo = $conteudo->paginate();
        return ArquivosResource::collection($conteudo);
    }

    public function historico(Request $request): JsonResponse
    {
        $historico = HistoricoArquivo::query();

        if ($request->has('termo') && $request->has('tipo')) {
            $termo = $request->get('termo');
            $tipo = $request->get('tipo');

            if ($tipo === 'data') {
                $date = Carbon::createFromFormat('d/m/Y', $termo);
                $intervaloData = [
                    $date?->format('Y-m-d') . " 00:00:00",
                    $date?->format('Y-m-d') . " 23:59:59",
                ];

                $historico->whereBetween('created_at', $intervaloData);
            }

            if ($tipo === 'nome') {
                $historico->where('nome_arquivo', 'LIKE', "%{$termo}%");
            }
        }

        $historico = $historico->paginate();
        return response()->json($historico);
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
