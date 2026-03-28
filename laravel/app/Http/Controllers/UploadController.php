<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Services\FileImportService;
use App\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct(
        private FileImportService $importService,
        private UploadService $uploadService
    ) {}

    public function store(Request $request): JsonResponse
    {
        logger()->info('Receiving file.');

        try {
            $upload = $this->importService->import($request->file('file'));

            logger()->info('File imported successfully. Upload ID => ' . $upload->_id);

            return response()->json([
                'message'      => 'File imported successfully.',
                'upload_id'    => (string) $upload->_id,
                'original_name' => $upload->original_name,
                'rows_imported' => $upload->rows_imported,
                'status'       => $upload->status,
            ], 201);

        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error importing file: ' . $e->getMessage()], 500);
        }
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->uploadService->list($request));
    }
}
