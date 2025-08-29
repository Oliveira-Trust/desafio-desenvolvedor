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

        // Tentar pegar do cache
        $cached = Cache::get($queryKey);
        if ($cached) {
            return $cached;
        }


        $search = $this->importDataFileRepository->pushCriteria(new ImportDataFileSearchCriteria($request))->paginate(10);
        
        $response = ImportDataFileResource::collection($search)
            ->additional(
                ['message' => 'Success']
            )
            ->response()
            ->setStatusCode(200);

        // Armazenar no cache por 10 minutos
        Cache::put($queryKey, $response, 600);

        return $response;

        
    }
}
