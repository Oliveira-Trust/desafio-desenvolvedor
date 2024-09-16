<?php
namespace App\Services;

use App\Models\Upload;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FileContentImport;

class UploadService
{
    public function storeUpload($fileName, $filePath)
    {
        return Upload::create([
            'file_name' => $fileName,
            'file_path' => '/storage/' . $filePath,
        ]);
    }

    public function processFile($file, $uploadId)
    {
        Excel::import(new FileContentImport($uploadId), $file);
    }
}
