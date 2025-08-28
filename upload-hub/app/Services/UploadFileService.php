<?php

namespace App\Services;

use App\Criteria\UploadFileHistorySelectCriteria;
use App\Http\Resources\UploadFileResource;
use App\Jobs\ProcessImportDataJob;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use App\Repositories\UploadFileRepository;

class UploadFileService
{
    public function __construct(
        private UploadFileRepository $uploadFileRepository
    )
    {
    }

    public function upload(Request $data)
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
            

            ProcessImportDataJob::dispatch($uploadFile->id, $path);

            return UploadFileResource::make($uploadFile)
                ->additional(
                    ['message' => 'File uploaded successfully']
                )
                ->response()
                ->setStatusCode(202);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'An error occurred during file upload.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function history($request)
    {
        $data = $request->all();

        if (empty($data)) {
            return response()->json([
                'message' => 'At least one filter (original_name or date) must be provided.'
            ], 400);
        }


        $uploadFiles = $this->uploadFileRepository->pushCriteria(new UploadFileHistorySelectCriteria())->all();
        

        return UploadFileResource::collection($uploadFiles);
    }
}