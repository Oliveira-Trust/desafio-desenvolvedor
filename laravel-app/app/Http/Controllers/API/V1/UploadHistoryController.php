<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UploadResource;
use App\Models\Upload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Upload History",
 *     description="API endpoints for upload history management"
 * )
 */
class UploadHistoryController extends Controller
{
    /**
     * List uploads with pagination.
     *
     * @OA\Get(
     *     path="/api/v1/uploads",
     *     summary="Get upload history",
     *     description="Returns a paginated list of uploaded files with their processing status",
     *     operationId="getUploads",
     *     tags={"Upload History"},
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter uploads by status",
     *         required=false,
     *         @OA\Schema(type="string", enum={"pending", "processing", "completed", "failed"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of uploads",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="original_name", type="string", example="financial_data.csv"),
     *                     @OA\Property(property="file_name", type="string", example="uploads/abcdef123456.csv"),
     *                     @OA\Property(property="file_size", type="integer", example=1024),
     *                     @OA\Property(property="file_type", type="string", example="csv"),
     *                     @OA\Property(property="status", type="string", example="completed"),
     *                     @OA\Property(property="total_records", type="integer", example=1000),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="processed_at", type="string", format="date-time")
     *                 )
     *             ),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $status = $request->input('status');
        
        $query = Upload::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc');
            
        if ($status) {
            $query->where('status', $status);
        }
        
        $uploads = $query->paginate($perPage);
        
        return response()->json(UploadResource::collection($uploads));
    }
    
    /**
     * Get a specific upload by ID.
     *
     * @OA\Get(
     *     path="/api/v1/uploads/{id}",
     *     summary="Get upload details",
     *     description="Returns detailed information about a specific upload",
     *     operationId="getUpload",
     *     tags={"Upload History"},
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Upload ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Upload details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="original_name", type="string", example="financial_data.csv"),
     *             @OA\Property(property="file_name", type="string", example="uploads/abcdef123456.csv"),
     *             @OA\Property(property="file_size", type="integer", example=1024),
     *             @OA\Property(property="file_type", type="string", example="csv"),
     *             @OA\Property(property="status", type="string", example="completed"),
     *             @OA\Property(property="total_records", type="integer", example=1000),
     *             @OA\Property(property="error_message", type="string", nullable=true),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="processed_at", type="string", format="date-time", nullable=true)
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
     *         response=403,
     *         description="Forbidden - Not authorized to view this upload",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="You are not authorized to view this upload")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found - Upload does not exist",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Upload not found")
     *         )
     *     )
     * )
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function show(int $id, Request $request): JsonResponse
    {
        $upload = Upload::findOrFail($id);
        
        if ($upload->user_id !== $request->user()->id) {
            return response()->json(['error' => 'You are not authorized to view this upload'], 403);
        }
        
        return response()->json(new UploadResource($upload));
    }
} 