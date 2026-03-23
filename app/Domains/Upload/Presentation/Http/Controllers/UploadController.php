<?php

namespace App\Domains\Upload\Presentation\Http\Controllers;

use App\Domains\Upload\Application\Services\UploadService;
use App\Domains\Upload\Presentation\Http\Requests\IndexUploadRequest;
use App\Domains\Upload\Presentation\Http\Requests\StoreUploadRequest;
use App\Http\Controllers\Controller;
use App\Shared\Responses\ApiSuccess;
use Illuminate\Http\JsonResponse;

class UploadController extends Controller
{
    public function store(StoreUploadRequest $request, UploadService $uploadService): JsonResponse
    {
        $validated = $request->validated();
        $requestId = $request->attributes->get('request_id');

        $uploadedFile = $validated['file'];
        $upload = $uploadService->uploadFile($uploadedFile, $requestId);
        $request->attributes->set('upload_id', $upload->id);

        return ApiSuccess::make(
            data: [
                'message' => 'Upload recebido com sucesso.',
                'upload' => [
                    'id' => $upload->id,
                    'filename' => $upload->filename,
                    'path' => $upload->path,
                    'mime_type' => $upload->mimeType,
                    'size' => $upload->size,
                    'status' => $upload->status,
                    'rows_total' => $upload->rowsTotal,
                    'processed_rows' => $upload->processedRows,
                    'failed_rows' => $upload->failedRows,
                    'error_message' => $upload->errorMessage,
                    'created_at' => $upload->createdAt,
                ],
            ],
            meta: [
                'request_id' => $requestId,
            ],
            status: 202,
        );
    }

    public function index(IndexUploadRequest $request, UploadService $uploadService): JsonResponse
    {
        $validated = $request->validated();

        $uploads = $uploadService->uploadList(
            perPage: (int) ($validated['per_page'] ?? 10),
            filename: $validated['filename'] ?? null,
            date: $validated['date'] ?? null,
        );
        $items = array_map(
            static fn ($upload): array => [
                'id' => $upload->id,
                'filename' => $upload->filename,
                'path' => $upload->path,
                'mime_type' => $upload->mimeType,
                'size' => $upload->size,
                'status' => $upload->status,
                'rows_total' => $upload->rowsTotal,
                'processed_rows' => $upload->processedRows,
                'failed_rows' => $upload->failedRows,
                'error_message' => $upload->errorMessage,
                'created_at' => $upload->createdAt,
                'updated_at' => $upload->updatedAt,
                'processed_at' => $upload->processedAt,
            ],
            $uploads->items()
        );

        return ApiSuccess::make(
            data: $items,
            meta: [
                'current_page' => $uploads->currentPage(),
                'last_page' => $uploads->lastPage(),
                'per_page' => $uploads->perPage(),
                'total' => $uploads->total(),
            ]
        );
    }
}
