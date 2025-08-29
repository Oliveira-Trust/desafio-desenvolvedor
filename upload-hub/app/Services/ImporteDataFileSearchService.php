<?php

namespace App\Services;

use App\Criteria\ImportDataFileSearchCriteria;
use App\Http\Resources\ImportDataFileResource;
use App\Repositories\ImportDataFileRepository;
use Illuminate\Support\Facades\Cache;

class ImporteDataFileSearchService
{
    public function __construct(private ImportDataFileRepository $importDataFileRepository)
    {
    }

    public function search($request)
    {
        $page = $request->get('page', 1);
        $queryKey = md5(json_encode($request->all()) . '_page_' . $page); //Garante que cada combinação de filtros + página tenha cache separado.

        // Pega dados do cache ou executa a query
        $data = Cache::remember($queryKey, 600, function () use ($request) {
            $search = $this->importDataFileRepository
                ->pushCriteria(new ImportDataFileSearchCriteria($request))
                ->paginate(10);

            return ImportDataFileResource::collection($search)
                ->additional(['message' => 'Success'])
                ->response()
                ->getData(true); // <- retorna como array/json puro
        });

       return response()->json($data);
        
    }
}
