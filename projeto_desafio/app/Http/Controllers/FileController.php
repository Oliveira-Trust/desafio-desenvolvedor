<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Requests\HistoryRequest;
use App\Http\Requests\SearchRequest;
use App\Services\InstrumentsConsolidatedFileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FileController extends Controller
{
    public function __construct(
        protected InstrumentsConsolidatedFileService $instrumentsConsolidatedFileService
    ){}

    public function upload(FileRequest $request): JsonResponse
    {
        $files = $request->file('files');

        foreach ($files as $file){
            $this->instrumentsConsolidatedFileService->upload($file);
        }

        return response()->json([
            'message' => 'Arquivo adicionado na fila de processamento.'
        ]);
    }

    public function history(HistoryRequest $request): JsonResponse|Response
    {
        $filter = $request->only(['filename', 'created_at']);

        $searchReturn = $this->instrumentsConsolidatedFileService->searchUploadedFileHistory($filter);
        if($searchReturn->count() == 0)
            return response()->noContent();

        return response()->json($searchReturn);
    }

    public function search(SearchRequest $request): JsonResponse|Response
    {
        $filter = $request->only(['TckrSymb', 'RptDt']);

        $searchReturn = $this->instrumentsConsolidatedFileService->searchContent($filter);
        if($searchReturn->count() == 0)
            return response()->noContent();

        return response()->json(
            $searchReturn
        );
    }
}
