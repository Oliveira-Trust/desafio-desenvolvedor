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

    public function upload(Request $request)
    {
        try{
            $file = $request->file('file');
            $original_name = $file->getClientOriginalName();
            $hash = md5_file($file->getRealPath());

            $exists = $this->uploadFileRepository->findWhere([
                'hash' => $hash
            ]);

            
            if ($exists->count()) {
                return response()->json([
                    'message' => 'File with the same name already exists.'
                ], 409);
            }        

            $path = $file->storeAs('uploads', $original_name);

            $data = [
                'path' => $path,
                'original_name' => $original_name,
                'user_id' => auth()->id() ?? null,
                'hash' => $hash,
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

        try{
            $uploadFiles = $this->uploadFileRepository->pushCriteria(new UploadFileHistorySelectCriteria($data))->all();

            return UploadFileResource::collection($uploadFiles);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'An error occurred while fetching upload history.',
                'error' => $e->getMessage()
            ], 500);
        }
        

    }
}