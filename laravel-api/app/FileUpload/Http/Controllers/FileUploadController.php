<?php

declare(strict_types=1);

namespace App\FileUpload\Http\Controllers;

use App\Base\Http\Controllers\Controller;
use App\FileUpload\Http\Controllers\Requests\UploadFileRequest;
use App\FileUpload\Interfaces\FileUploadRepositoryInterface;
use App\FileUpload\Services\FileUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function __construct(
        private FileUploadService $service,
        private readonly FileUploadRepositoryInterface $fileUploadRepository
    ) {}

    public function index(Request $request): JsonResponse
    {
        $uploads = $this->fileUploadRepository->getFilesUploads($request->name, $request->date);

        return response()->json($uploads);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->fileUploadRepository->find($id));
    }

    public function store(UploadFileRequest $request): JsonResponse
    {
        $result = $this->service->handle($request->file('file'));

        return response()->json([
            'message' => 'File accepted and queued for processing.',
            'upload' => $result,
        ], 202);
    }
}
