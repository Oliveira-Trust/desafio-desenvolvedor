<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessInstrumentUpload;
use App\Jobs\SendEmailInstrumentsJob;
use App\Models\UploadHistory;
use App\Services\InstrumentsService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Throwable;

/**
 * @group Uploads
 * 
 * Group for handling the instruments upload.
 */
class UploadController extends Controller
{
    /**
     * List Upload History
     *
     * Returns a paginated list of uploads.
     * The data is cached for 30 minutes to optimize performance on repetitive queries.
     * @authenticated
     * @withoutResponses
     * @queryParam file_name string Partial filter by file name. Example: report
     * @queryParam reference_date date Filter by reference date. (YYYY-MM-DD). Example: 2026-03-24
     * @queryParam page int Page number for pagination. Example: 1
     * @response 200 {
     * "current_page": 1,
     * "data": [
     * {
     * "id": 1,
     * "user_id": 2,
     * "file_name": "Instruments_20260324.csv",
     * "reference_date": "2026-03-24",
     * "status": "completed",
     * "total_rows": 120879,
     * "created_at": "2026-03-24T22:08:44.000000Z"
     * }
     * ],
     * "first_page_url": "http://localhost/api/v1/uploads?page=1",
     * "from": 1,
     * "last_page": 1,
     * "last_page_url": "http://localhost/api/v1/uploads?page=1",
     * "links": [
     * { "url": null, "label": "&laquo; Previous", "page": null, "active": false },
     * { "url": "http://localhost/api/v1/uploads?page=1", "label": "1", "page": 1, "active": true },
     * { "url": null, "label": "Next &raquo;", "page": null, "active": false }
     * ],
     * "next_page_url": null,
     * "path": "http://localhost/api/v1/uploads",
     * "per_page": 10,
     * "prev_page_url": null,
     * "to": 1,
     * "total": 1
     * }
     * @response 422 {
     * "message": "The reference date field must match the format Y-m-d.",
     * "errors": {
     * "reference_date": ["The reference date field must match the format Y-m-d."]
     * }
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function index(Request $request)
    {
        $fileName = $request->query('file_name');
        $referenceDate = $request->query('reference_date');
        $page = $request->query('page', 1);
        
        if($referenceDate){
            $request->validate([
                "reference_date" => "required|date_format:Y-m-d"
            ]);
        }

        $cacheKey = "global_history_f:{$fileName}_d:{$referenceDate}_p:{$page}";

        return Cache::tags(['instruments_history'])->remember($cacheKey, now()->addMinutes(30), function() use ($fileName, $referenceDate) {
            return UploadHistory::query()
                ->when($fileName, fn($q) => $q->where('file_name', 'like', "%{$fileName}%"))
                ->when($referenceDate, fn($q) => $q->where('reference_date', $referenceDate))
                ->latest()
                ->paginate(10)
                ->toArray();
        });
    }

    /**
     * Upload Instruments
     *
     * This endpoint receives the file, verifies if it's a valid document, if the reference date matches the file, and runs background jobs to save the data. Finally, it sends an email informing the upload status.
     * @authenticated
     * @withoutResponses
     * @bodyParam file file required The instruments file from B3 (CSV, XLSX) 
     * @bodyParam reference_date date required The reference date for the file data (YYYY-MM-DD). Example: 2026-03-22
     * @response 202 {
     * "message": "File received and being processed; you will be notified by email upon completion."
     * }
     * @response 422 {
     * "message": "Date mismatch: File is for 2026-01-01, but reference date is 2026-03-23."
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:csv,txt,xlsx,xls',
                'max:102400' // 100 MB
            ],
            'reference_date' => "required|date"    
        ]);

        try{
            $service = new InstrumentsService($request->file('file'), $request->reference_date);
            $archive = $service->saveFile();

            $history = UploadHistory::create([
                'user_id' => auth()->user()->id,
                'file_name' => $archive['fileName'],
                'file_hash' => $archive['hash'],
                'reference_date' => $archive['date'],
                'status' => 'pending'
            ]);

            Bus::chain([
                new ProcessInstrumentUpload($history, $archive['path']),
                new SendEmailInstrumentsJob($history, null),
            ])->catch(function (Throwable $e) use ($history) {
                SendEmailInstrumentsJob::dispatch($history, $e->getMessage());
            })->dispatch();

            return response()->json([
                "message" => "File received and being processed; you will be notified by email upon completion.",
            ], 202);
        }catch(Exception $error) {
            return response()->json([
                "message" => $error->getMessage(),
            ], $error->getCode() ?: 400);
        }
    }
}
