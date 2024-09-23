<?php

namespace App\Http\Controllers\Documento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arquivo as RequestsArquivo;
use App\Jobs\ProcessaArquivoCsv;
use App\Models\Arquivo;
use App\Services\Documento\ArquivoService;
use App\Services\Documento\HistoricoArquivoService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArquivosController extends Controller
{            
        public function __construct(private ArquivoService $arquivoService, private  HistoricoArquivoService $historicoArquivoService)
        {
                
        }
        public function upload(RequestsArquivo $request)
        {                   
                $dados = $this->arquivoService->processar($request->file('file'));
                ProcessaArquivoCsv::dispatch(Storage::disk('public')->path($dados['diretorio']));
                return response()->json(['message' => 'Arquivo processado corretamente'], 200);
        }

        public function historico(Request $request)
        {               
                $arquivos = $this->historicoArquivoService->historico($request);
                return response()->json(['arquivos' => $arquivos], 200);
        }
}