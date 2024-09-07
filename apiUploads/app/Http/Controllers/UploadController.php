<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use App\Helpers\FileHelper;


class UploadController extends Controller
{
    public function upload(Request $request)
    {
        FileHelper::validateUpload($request);
        $file = $request->file("file");
        $fileName = $file->getClientOriginalName();
        $fileHash = hash_file('md5', $file->getRealPath());

        $fileExists = $this->verifyFileExists($fileHash);

        if (!$fileExists) {
            
            $path = $file->storeAs('uploads', $fileName);

            $upload = new Upload();
            $upload->file_name = $fileName;
            $upload->file_path = $path;
            $upload->file_type = $file->getClientOriginalExtension();
            $upload->save();

            return response()->json(['message' => 'Arquivo carregado com sucesso!'], 201);
        }
        return response()->json(['message' => 'Arquivo já foi carregado.'], 400);
    }

    public function verifyFileExists($fileHash)
    {
        if (Upload::where('file_hash', $fileHash)->exists()) {
            return response()->json(['message' => 'Arquivo já foi enviado.'], 409);
        }
    }
}
