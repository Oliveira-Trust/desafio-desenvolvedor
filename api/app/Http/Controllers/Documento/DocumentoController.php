<?php

namespace App\Http\Controllers\Documento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Arquivo as RequestsArquivo;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
            public function upload(RequestsArquivo $request)
            {   
                        if ($request->hasFile('file')) {     
                                $arquivo = $request->file();
                                $nomeArquivo = $arquivo->getClientOriginalName();
                                $diretorio = $arquivo->storeAs('uploads', $nomeArquivo, 'public');

                                return response()->json([
                                        'nome_arquivo' => $nomeArquivo,
                                        'diretorio' => $diretorio,
                                        'url' => Storage::url($diretorio)
                                ]);
                        }

                        return response()->json([
                                'erro' => 'Arquivo não encontrado' 
                        ], 400);
         }
}