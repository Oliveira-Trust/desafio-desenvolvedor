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
                    'mime_type' => $upload->mimeType,
                    'size' => $upload->size,
                    'status' => $upload->status,
                    'processed_rows' => $upload->processedRows,
                    'failed_rows' => $upload->failedRows,
                    'error_message' => $upload->errorMessage,
                    'created_at' => $upload->createdAt,
                ],
            ],
            status: 202,
        );
    }

    public function index(Request $request, UploadService $uploadService): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 10);

        $filename = $request->string('filename')->toString();
        $date = $request->string('date')->toString();

        $uploads = $uploadService->uploadList(
            perPage: $perPage,
            filename: $filename ?: null,
            date: $date ?: null,
        );
        $items = array_map(
            static fn ($upload): array => [
                'id' => $upload->id,
                'filename' => $upload->filename,
                'path' => $upload->path,
                'mime_type' => $upload->mimeType,
                'size' => $upload->size,
                'status' => $upload->status,
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
