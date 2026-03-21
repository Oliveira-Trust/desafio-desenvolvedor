<?php

namespace App\Domains\Upload\Presentation\Http\Controllers;

use App\Domains\Upload\Application\Services\UploadService;
use App\Domains\Upload\Presentation\Http\Requests\StoreUploadRequest;
use App\Http\Controllers\Controller;
use App\Shared\Responses\ApiSuccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(StoreUploadRequest $request, UploadService $uploadService): JsonResponse
    {
        $validated = $request->validated();

        $uploadedFile = $validated['file'];
        $upload = $uploadService->uploadFile($uploadedFile);

        return ApiSuccess::make(
            data: [
                'message' => 'Upload recebido com sucesso.',
                'upload' => [
                    'id' => $upload->id,
                    'filename' => $upload->filename,
                    'path' => $upload->path,
                    'mime_type' => $upload->mime_type,
                    'size' => $upload->size,
                    'status' => $upload->status,
                    'created_at' => $upload->created_at,
                ],
            ],
            status: 202,
        );
    }

    public function index(Request $request, UploadService $uploadService): JsonResponse
    {
        $uploads = $uploadService->uploadList();

        return ApiSuccess::make(
            data: $uploads,
            meta: [
                'total' => count($uploads),
            ],
        );
    }
}
