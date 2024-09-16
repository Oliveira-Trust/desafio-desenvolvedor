<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileService
{
    public function storeFile(UploadedFile $file, $directory = 'uploads')
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs($directory, $fileName, 'public');
        return $filePath;
    }

    public function getFilePath($fileName, $directory = 'uploads')
    {
        return asset("storage/$directory/$fileName");
        dd($fileName);
    }

    public function listFiles($directory = 'uploads')
    {
        return Storage::disk('public')->files($directory);
    }
}
