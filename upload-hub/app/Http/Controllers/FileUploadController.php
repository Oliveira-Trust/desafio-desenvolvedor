<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Services\FileUploadService;

class FileUploadController extends Controller
{
    public function __construct(
        private FileUploadService $fileUploadService
    )
    {        
    }

    public function store(FileUploadRequest $request)
    {
        return $this->fileUploadService->store($request);
    }
}
