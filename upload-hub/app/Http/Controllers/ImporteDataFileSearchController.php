<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportDataFileRequest;
use App\Services\ImporteDataFileSearchService;
use Illuminate\Http\Request;

class ImporteDataFileSearchController extends Controller
{
    public function __construct(private ImporteDataFileSearchService $importDataFileSearchService)
    {
    }   

    public function search(ImportDataFileRequest $request)
    {
        return $this->importDataFileSearchService->search($request);
    }
}
