<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileHistoryRequest;
use App\Http\Requests\UploadFileRequest;
use App\Services\UploadFileService;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function __construct(
        private UploadFileService $uploadFileService
    )
    {        
    }

    public function upload(UploadFileRequest $request)
    {
        return $this->uploadFileService->upload($request);
    }

    public function history(UploadFileHistoryRequest $request)
    {
        return $this->uploadFileService->history($request);
    }
    
}
