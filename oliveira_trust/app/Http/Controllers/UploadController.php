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
}
