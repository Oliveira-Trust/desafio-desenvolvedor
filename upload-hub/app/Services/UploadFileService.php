<?php

namespace App\Services;

use App\Jobs\ProcessImportDataJob;
use Illuminate\Http\Request;
use App\Repositories\UploadFileRepository;
use Illuminate\Support\Facades\Log;

class UploadFileService
{
    public function __construct(
        private UploadFileRepository $uploadFileRepository
    )
    {
    }

    public function store(Request $data)
    {
       
        $file = $data->file('file');
        $original_name = $file->getClientOriginalName();

        $exists = $this->uploadFileRepository->findWhere([
            'original_name' => $original_name
        ]);

        
        if ($exists->count()) {
            return response()->json([
                'message' => 'File with the same name already exists.'
            ], 409);
        }

        try{

            $path = $file->store('uploads');

            $data = [
                'path' => $path,
                'original_name' => $original_name,
                'user_id' => auth()->id() ?? null,
                'rows_expected' => 0,
                'rows_processed' => 0,
            ];

            $uploadFile = $this->uploadFileRepository->create($data);
            
            Log::info('Dispatching job');

            ProcessImportDataJob::dispatch($uploadFile->id, $path);

            Log::info('Valta job');

            return response()->json([
                'message' => 'File uploaded successfully.'
            ], 202);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'An error occurred during file upload.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}