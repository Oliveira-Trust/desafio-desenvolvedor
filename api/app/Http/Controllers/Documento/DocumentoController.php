<?php

namespace App\Http\Controllers\Documento;

use App\Http\Controllers\Controller;
use App\Services\Documento\ConteudoDocumentoService;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function __construct(private ConteudoDocumentoService $documentoService)
    {
    }
    public function filtro(Request $request)
    {
        return response()->json($this->documentoService->filtro($request));
    }
}