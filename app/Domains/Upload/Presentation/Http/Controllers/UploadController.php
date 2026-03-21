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
        $path = $uploadService->uploadFile($uploadedFile);

        return ApiSuccess::make(
            data: [
                'message' => 'Upload recebido com sucesso.',
                'file_name' => $uploadedFile->getClientOriginalName(),
                'stored_path' => $path,
            ],
            message: 'Upload realizado com sucesso.',
            status: 202,
        );
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'data' => ['message' => 'Lista de uploads'],
        ], 200);
    }
}