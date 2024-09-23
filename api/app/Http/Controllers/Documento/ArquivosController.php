<?php

namespace App\Http\Controllers\Documento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arquivo as RequestsArquivo;
use App\Jobs\ProcessaArquivoCsv;
use App\Services\Documento\ArquivoService;
use Illuminate\Support\Facades\Storage;

class ArquivosController extends Controller
{            
        public function __construct(private ArquivoService $arquivoService)
        {
                
        }
        public function upload(RequestsArquivo $request)
        {                   
                $dados = $this->arquivoService->processar($request->file('file'));
                ProcessaArquivoCsv::dispatch(Storage::disk('public')->path($dados['diretorio']));
                return response()->json(['message' => 'Arquivo processado corretamente'], 200);
        }
}