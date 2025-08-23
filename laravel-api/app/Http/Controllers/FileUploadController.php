<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\UploadedFile;
use App\Jobs\ProcessUploadedFile;

class FileUploadController extends Controller
{

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimetypes:text/plain,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $mime = $file->getMimeType();
        $extension = strtolower($file->getClientOriginalExtension());
        
        if ($mime === 'text/plain' && $extension !== 'csv') {
            return response()->json(['error' => 'Apenas arquivos CSV e Excel são permitidos'], 422);
        }
        
        $hash = hash_file('sha256', $file->getRealPath());
        
        if (UploadedFile::where('file_hash', $hash)->exists()) {
            return response()->json(['error' => 'Arquivo já enviado'], 409);
        }
        
        $filePath = $file->storeAs('uploads', $file->getClientOriginalName());

        UploadedFile::create([
            'file_name'   => $file->getClientOriginalName(),
            'file_hash'   => $hash,
        ]);
        
        ProcessUploadedFile::dispatch(storage_path('app/private/'.$filePath), $extension, $hash);

        return response()->json(['message' => 'Upload realizado e enviado para processamento']);
    }

}
