<?php

namespace App\Services;

use App\Repositories\FileUploadRepository;
use Illuminate\Http\Request;

class UploadFileService
{
    public function __construct(
        private FileUploadRepository $fielUploadRepository
    )
    {
    }

    public function store(Request $data)
    {
       
        $file = $data->file('file');
        $original_name = $file->getClientOriginalName();

        $exists = $this->fielUploadRepository->findWhere([
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

            $this->fielUploadRepository->create($data);

            //todo:: job pra processar o arquivo

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