<?php

namespace App\Http\Controllers\Documento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arquivo as RequestsArquivo;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
            public function upload(RequestsArquivo $request)
            {   
                                $arquivo = $request->file('file');
                                $nomeArquivo = $arquivo->getClientOriginalName();
                                $diretorio = $arquivo->storeAs('uploads',$nomeArquivo,  'public');

                                return response()->json([
                                        'nome_arquivo' => $diretorio,
                                        'diretorio' => $diretorio,
                                        'url' => Storage::url($diretorio) // public para download
                               ]);
         }
}