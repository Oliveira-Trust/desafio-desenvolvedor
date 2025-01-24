<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;

class UploadController extends Controller
{
    public function uploadFile(Request $request) 
    {
        $request->validate([
            'file' => 'required|file|mimetypes:text/plain,text/csv,xlsx',
        ]);
        
        $file = $request->file('file');

        $fileName = $file->getClientOriginalName();

        $filePath = $file->storeAs('private/uploads', $fileName);

        $upload = new Upload();
        $upload->file_name = $fileName;
        $upload->file_path = $filePath;
        $upload->save();

        return response()->json([
            'message' => 'File uploaded successfully!',
            'file_id' => $upload->id
        ], 201);

    }

    public function getUploadHistory(Request $request)
    {
        // parâmetros de busca
        $fileName = $request->query('file_name');
        $referenceDate = $request->query('referenceDate');

        
        $uploads = Upload::query();
        if (!empty($fileName)) {// Filtro por nome do arquivo
            $uploads->where('file_name', 'like', '%' . $fileName . '%');
        }
        if (!empty($referenceDate)) {// Filtro pela data
            $uploads->whereDate('created_at', $referenceDate);
        }
        $resultado = $uploads->orderBy('updated_at', 'desc')->get();

        
        if ($resultado->isEmpty()) {
            return response()->json([
                'message' => 'Nenhum arquivo encontrado com os critérios especificados.'
            ], 404);
        }

        return response()->json($resultado);
    }

    public function searchFileContent(Request $request, $id)
    {
        $arquivo = Upload::find($id);
        if (!$arquivo) {
            return response()->json(['error' => 'Arquivo não encontrado no sistema.'], 404);
        }

        $filePath = storage_path('app/private/' . $arquivo->file_path);

        // paginação
        $page = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);

        // Filtros
        $filtros = [];
        if ($request->has('RptDt')) {
            $filtros['RptDt'] = $request->query('RptDt');
        }
        if ($request->has('TckrSymb')) {
            $filtros['TckrSymb'] = $request->query('TckrSymb');
        }

        // Ler o arquivo e paginar os resultados
        $resultado = Upload::lerArquivoPaginado($filePath, $page, $perPage, $filtros);

        if ($resultado->isEmpty()) {
            return response()->json([
                'message' => 'Nenhum registro encontrado com os critérios especificados.'
            ], 404);
        }

        return response()->json($resultado);
    }
}
