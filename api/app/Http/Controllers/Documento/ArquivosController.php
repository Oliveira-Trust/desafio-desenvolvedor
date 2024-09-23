<?php

namespace App\Http\Controllers\Documento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arquivo as RequestsArquivo;
use App\Services\Documento\ArquivoService;

class ArquivosController extends Controller
{            
        public function __construct(private ArquivoService $arquivoService)
        {
                
        }
        public function upload(RequestsArquivo $request)
        {                   
                $this->arquivoService->processar($request->file('file'));
                return response()->json(['message' => 'Arquivo processado corretamente'], 200);
        }
}