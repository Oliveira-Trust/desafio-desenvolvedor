<?php

declare(strict_types=1);

namespace App\FileUpload\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\FileUpload\Http\Controllers\Requests\FileUploadRequest;
use App\FileUpload\Http\Controllers\Resources\FileUploadResource;
use App\FileUpload\Interfaces\FileUploadRepositoryInterface;
use App\FileUpload\Services\FileUploadService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FileUploadController extends Controller
{
    public function __construct(
        private FileUploadService $service,
        private readonly FileUploadRepositoryInterface $fileUploadRepository
    ) {}

    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:150'],
            'reference_date' => ['nullable', 'date_format:Y-m-d'],
        ]);
        $uploads = $this->fileUploadRepository->getFilesUploads($request->name, $request->reference_date);

        return response()->json(
            FileUploadResource::collection($uploads)
        );
    }

    public function store(FileUploadRequest $request): JsonResponse
    {
        try {
            $result = $this->service->handle($request->file('file'));

            return response()->json([
                'status' => 'success',
                'message' => 'Arquivo aceito e enfileirado para processamento.',
                'upload' => $result,
            ], 202);
        } catch (Exception $e) {
            Log::channel('upload_file')->error("Erro ao subir o arquivo, {$e->getMessage()}");

            return response()->json([
                'status' => 'erro',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
