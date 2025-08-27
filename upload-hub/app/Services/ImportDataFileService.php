<?php

namespace App\Services;

use App\Entities\ImportFile;
use Illuminate\Http\Request;
use App\Repositories\ImportFileRepository;

class ImportDataFileService
{
    public function __construct(
        private ImportFileRepository $importFileRepository
    )
    {
    }

    public function processFile()
    {
        $idUploadedFile = session('id_uploaded_file');
    }
}