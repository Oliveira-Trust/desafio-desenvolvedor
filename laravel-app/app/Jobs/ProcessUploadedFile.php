<?php

namespace App\Jobs;

use App\Models\Upload;
use App\Repositories\MongoDbDataRepository;
use App\Services\FileProcessingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Carbon\Carbon;
use App\Jobs\InvalidateCache;

class ProcessUploadedFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The upload record.
     *
     * @var \App\Models\Upload
     */
    protected $upload;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 3600;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = [30, 60, 120];

    /**
     * Create a new job instance.
     *
     * @param \App\Models\Upload $upload
     * @return void
     */
    public function __construct(Upload $upload)
    {
        $this->upload = $upload;
    }

    /**
     * Execute the job.
     *
     * @param \App\Services\FileProcessingService $fileService
     * @param \App\Repositories\MongoDbDataRepository $repository
     * @return void
     */
    public function handle(FileProcessingService $fileService, MongoDbDataRepository $repository)
    {
        try {
            Log::info("Starting to process upload ID: {$this->upload->id}");
            
            $this->upload->status = 'processing';
            $this->upload->save();
            
            $data = $fileService->processFile($this->upload);
            
            $filteredData = [];
            foreach ($data as $row) {
                $filteredRow = [
                    'RptDt' => $row['RptDt'] ?? null,
                    'TckrSymb' => $row['TckrSymb'] ?? null,
                    'MktNm' => $row['MktNm'] ?? null,
                    'SctyCtgyNm' => $row['SctyCtgyNm'] ?? null,
                    'ISIN' => $row['ISIN'] ?? null,
                    'CrpnNm' => $row['CrpnNm'] ?? null,
                ];
                $filteredData[] = $filteredRow;
            }
            
            $result = $repository->bulkInsert($filteredData);
            
            if (!$result) {
                throw new \Exception("Failed to insert data into database");
            }
            
            $this->upload->status = 'completed';
            $this->upload->processed_at = Carbon::now();
            $this->upload->total_records = count($filteredData);
            $this->upload->save();
            
            InvalidateCache::dispatch('data_search_*');
            
            Log::info("Successfully processed upload ID: {$this->upload->id}. Records imported: " . count($filteredData));
        } catch (\Exception $e) {
            Log::error("Error processing upload ID: {$this->upload->id}. Error: " . $e->getMessage());
            
            $this->upload->status = 'failed';
            $this->upload->error_message = $e->getMessage();
            $this->upload->save();
            
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     *
     * @param \Throwable $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        Log::error("Job for upload ID: {$this->upload->id} has failed after all retries. Error: " . $exception->getMessage());
        
        $this->upload->status = 'failed';
        $this->upload->error_message = "Failed after {$this->tries} attempts. Error: " . $exception->getMessage();
        $this->upload->save();
    }

    /**
     * Parse the file based on its extension.
     *
     * @param string $filePath
     * @param string $extension
     * @return array
     */
    protected function parseFile($filePath, $extension)
    {
        if (strtolower($extension) === 'csv') {
            return $this->parseCsv($filePath);
        } else {
            throw new \Exception("Unsupported file type: {$extension}");
        }
    }

    /**
     * Parse a CSV file.
     *
     * @param string $filePath
     * @return array
     */
    protected function parseCsv($filePath)
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        
        $records = $csv->getRecords();
        $data = [];
        
        foreach ($records as $record) {
            $data[] = $record;
        }
        
        return $data;
    }
} 