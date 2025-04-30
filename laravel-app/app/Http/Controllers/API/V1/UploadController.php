<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;
use App\Jobs\ProcessUploadedFile;
use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @OA\Tag(
 *     name="Uploads",
 *     description="API endpoints for file uploads"
 * )
 */
class UploadController extends Controller
{
    /**
     * Store a newly uploaded file.
     *
     * @OA\Post(
     *     path="/api/v1/upload",
     *     summary="Upload a file",
     *     description="Uploads a CSV or Excel file containing financial data for processing",
     *     operationId="uploadFile",
     *     tags={"Uploads"},
     *     security={ {"sanctum": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="binary",
     *                     description="The file to upload (CSV or Excel)"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="File uploaded successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="File uploaded successfully and queued for processing"),
     *             @OA\Property(property="upload", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="original_name", type="string", example="financial_data.csv"),
     *                 @OA\Property(property="file_name", type="string", example="uploads/abcdef123456.csv"),
     *                 @OA\Property(property="file_path", type="string", example="storage/uploads/abcdef123456.csv"),
     *                 @OA\Property(property="status", type="string", example="pending"),
     *                 @OA\Property(property="created_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request - duplicate file",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="This file has already been uploaded")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="file", type="array", @OA\Items(type="string", example="The file must be a file of type: csv, xlsx, xls"))
     *             )
     *         )
     *     )
     * )
     *
     * @param UploadFileRequest $request
     * @return JsonResponse
     */
    public function store(UploadFileRequest $request): JsonResponse
    {
        try {
            $file = $request->file('file');
            $referenceDate = $request->input('reference_date');
            
            $extension = $file->getClientOriginalExtension();
            if (!in_array(strtolower($extension), ['csv', 'xlsx', 'xls'])) {
                return response()->json([
                    'message' => 'Invalid file type. Only CSV and Excel files are allowed.',
                ], 422);
            }
            
            $fileHash = md5_file($file->getRealPath());
            $existingUpload = Upload::where('file_hash', $fileHash)->first();
            
            if ($existingUpload) {
                return response()->json([
                    'message' => 'This file has already been uploaded.',
                    'upload_id' => $existingUpload->id,
                ], 422);
            }
            
            $fileName = Str::uuid() . '.' . $extension;
            
            $filePath = $file->storeAs('', $fileName, 'uploads');
            
            $upload = Upload::create([
                'original_name' => $file->getClientOriginalName(),
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_hash' => $fileHash,
                'status' => 'pending',
                'reference_date' => $referenceDate ?? null,
            ]);
            
            ProcessUploadedFile::dispatch($upload);
            
            return response()->json([
                'message' => 'File uploaded successfully and queued for processing.',
                'upload' => $upload,
            ], 201);
        } catch (\Exception $e) {
            Log::error("Error uploading file: " . $e->getMessage());
            return response()->json([
                'message' => 'Failed to upload file.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Get the status of an upload.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $upload = Upload::findOrFail($id);
            
            return response()->json([
                'upload' => $upload,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Upload not found.',
            ], 404);
        }
    }
    
    /**
     * List all uploads with pagination.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $uploads = Upload::orderBy('created_at', 'desc')->paginate(15);
        
        return response()->json([
            'uploads' => $uploads,
        ]);
    }
} 