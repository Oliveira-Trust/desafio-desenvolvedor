<?php

namespace App\Domains\Upload\Infrastructure\Storage;

use App\Domains\Upload\Application\Ports\UploadStorage;
use Illuminate\Http\UploadedFile;

final class LocalUploadStorage implements UploadStorage
{
    public function store(UploadedFile $file, string $directory): string
    {
        return $file->store($directory);
    }
}
