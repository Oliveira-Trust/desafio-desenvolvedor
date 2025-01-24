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
}
