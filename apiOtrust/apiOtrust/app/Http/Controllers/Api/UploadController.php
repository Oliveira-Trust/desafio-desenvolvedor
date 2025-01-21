<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upload;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        if (Upload::where('file_name', $fileName)->exists()) {
            return response()->json(['error' => 'O arquivo já foi enviado.'], 400);
        }

        $path = $file->store('uploads');

        $data = []; 
        $fileContent = fopen(storage_path('app/' . $path), 'r');
        while (($row = fgetcsv($fileContent)) !== false) {
            $data[] = $row;
        }
        fclose($fileContent);

        Upload::create([
            'file_name' => $fileName,
            'upload_date' => now(),
            'data' => $data,
        ]);

        return response()->json(['message' => 'Arquivo enviado com sucesso.']);
    }
}
