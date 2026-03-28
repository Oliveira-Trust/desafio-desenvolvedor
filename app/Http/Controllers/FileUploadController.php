<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Http\Resources\FileUploadResource;
use App\Jobs\ProcessInstrumentFile;
use App\Models\FileUpload;
use App\Services\FileProcessingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function __construct(private readonly FileProcessingService $service)
    {
    }

    // ── POST /api/files ───────────────────────────────────────────────────────

    /**
     * Upload an instrument file (CSV / XLSX / XLS).
     *
     * The file is stored and queued for asynchronous processing.
     * Duplicate files (same SHA-256 hash) are rejected.
     */
    public function upload(UploadFileRequest $request): JsonResponse
    {
        $file = $request->file('file');
        $hash = $this->service->hashFile($file->getRealPath());

        if (FileUpload::where('hash', $hash)->exists()) {
            return response()->json([
                'message' => 'Este arquivo já foi enviado anteriormente.',
            ], 422);
        }

        $extension  = $file->getClientOriginalExtension();
        $storedName = Str::random(40) . '.' . $extension;
        $file->storeAs('uploads', $storedName, 'local');
        $referenceDate = $this->service->extractReferenceDate($file->getClientOriginalName());

        $upload = FileUpload::create([
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $storedName,
            'hash' => $hash,
            'status' => FileUpload::STATUS_PENDING,
            'reference_date' => $referenceDate,
            'total_records' => 0,
            'processed_records' => 0,
            'uploaded_by' => $request->user()->id,
        ]);

        ProcessInstrumentFile::dispatch((string)$upload->_id, $storedName);

        return response()->json([
            'message' => 'Arquivo recebido e enfileirado para processamento.',
            'data' => new FileUploadResource($upload),
        ], 202);
    }

    // ── GET /api/files ────────────────────────────────────────────────────────

    /**
     * List upload history.
     *
     * Optional query params:
     *   - name          : filter by original filename (partial match)
     *   - reference_date: filter by reference date (YYYY-MM-DD)
     *   - per_page      : items per page (default 15)
     */
    public function history(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'reference_date' => ['sometimes', 'date_format:Y-m-d'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ]);

        $query = FileUpload::orderBy('created_at', 'desc');

        if ($request->filled('name')) {
            $query->byName($request->name);
        }

        if ($request->filled('reference_date')) {
            $query->byReferenceDate($request->reference_date);
        }

        $perPage = (int)$request->get('per_page', 15);

        return FileUploadResource::collection($query->paginate($perPage));
    }

    // ── GET /api/files/{id} ───────────────────────────────────────────────────

    /**
     * Show a single upload record.
     */
    public function show(string $id): FileUploadResource
    {
        $upload = FileUpload::findOrFail($id);

        return new FileUploadResource($upload);
    }
}
