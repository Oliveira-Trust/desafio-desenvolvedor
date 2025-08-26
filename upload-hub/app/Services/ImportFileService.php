<?php

namespace App\Services;

use App\Entities\ImportFile;
use Illuminate\Http\Request;
use App\Repositories\ImportFileRepository;

class ImportFileService
{
    public function __construct(
        private ImportFileRepository $importFileRepository
    )
    {
    }

    public function teste()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
        ];

        $this->importFileRepository->create($data);
    }
}