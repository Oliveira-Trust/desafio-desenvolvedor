<?php

namespace Application\Files\Data;

use Spatie\LaravelData\Data;
use Illuminate\Http\UploadedFile;

class CreateFileData extends Data {
    public function __construct(public UploadedFile $file) {}
}
