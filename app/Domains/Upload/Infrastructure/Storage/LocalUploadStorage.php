<?php

namespace App\Domains\Upload\Infrastructure\Storage;

use App\Domains\Upload\Application\Ports\UploadStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

final class LocalUploadStorage implements UploadStorage
{
    public function store(UploadedFile $file, string $directory): string
    {
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'csv';
        $filename = Str::uuid() . '.' . $extension;

        return $file->storeAs($directory, $filename);
    }
}
