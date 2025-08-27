<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Services\UploadFileService;

class UploadFileController extends Controller
{
    public function __construct(
        private UploadFileService $uploadFileService
    )
    {        
    }

    public function store(UploadFileRequest $request)
    {
        return $this->uploadFileService->store($request);
    }
}
