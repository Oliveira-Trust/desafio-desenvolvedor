<?php

namespace App\Domains\Upload\Application\Ports;

use Illuminate\Http\UploadedFile;

interface UploadStorage
{
    public function store(UploadedFile $file, string $directory): string;
}