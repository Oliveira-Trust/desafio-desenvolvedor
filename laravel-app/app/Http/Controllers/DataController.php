<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\MongoDbDataRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancialDataExport;

class DataController extends Controller
{
    /**
     * @var MongoDbDataRepository
     */
    protected $repository;

    /**
     * Create a new controller instance.
     * 
     * @param MongoDbDataRepository $repository
     * @return void
     */
    public function __construct(MongoDbDataRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Exibe a interface de busca de dados com resultados filtrados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $results = [];
        $total = 0;
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 50);
        
        if ($this->hasSearchFilters($request)) {
            $cacheKey = 'data_search_' . md5(json_encode($request->except('page')));
            
            try {
                // Try to use cache
                $searchResults = Cache::remember($cacheKey, 60, function () use ($request, $page, $perPage) {
                    return $this->searchData($request, $page, $perPage);
                });
            } catch (\Exception $e) {
                // If cache fails, fetch data directly
                \Log::warning('Cache connection failed: ' . $e->getMessage());
                $searchResults = $this->searchData($request, $page, $perPage);
            }
            
            $results = $searchResults['data'] ?? [];
            $total = $searchResults['total'] ?? 0;
            
            if (!empty($results)) {
                $results = new LengthAwarePaginator(
                    $results,
                    $total,
                    $perPage,
                    $page,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            }
        }
        
        $stats = $this->repository->getStats();
        
        return view('data.search', [
            'results' => $results,
            'total' => $total,
            'stats' => $stats ?? [],
        ]);
    }
    
    /**
     * Exporta os resultados da busca para um arquivo Excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        return Excel::download(new FinancialDataExport($request->all()), 'dados_financeiros.xlsx');
    }
    
    /**
     * Verifica se a requisição possui filtros de busca.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function hasSearchFilters(Request $request)
    {
        return $request->anyFilled([
            'start_date', 'end_date', 'symbol', 'market', 
            'category', 'isin', 'company', 'upload_id'
        ]);
    }
    
    /**
     * Realiza a busca de dados utilizando o repositório MongoDB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $page
     * @param  int  $perPage
     * @return array
     */
    private function searchData(Request $request, $page = 1, $perPage = 50)
    {
        try {
            $filters = [];
            
            if ($request->filled('symbol')) {
                $filters['ticker'] = $request->input('symbol');
            }
            
            $dateFilter = $this->processDateFilters($request);
            if ($dateFilter) {
                $filters['date'] = $dateFilter;
            }
            
            $additionalFilters = [];
            
            if ($request->filled('market')) {
                $additionalFilters['market'] = $request->input('market');
            }
            
            if ($request->filled('category')) {
                $additionalFilters['category'] = $request->input('category');
            }
            
            if ($request->filled('isin')) {
                $additionalFilters['isin'] = $request->input('isin');
            }
            
            if ($request->filled('company')) {
                $additionalFilters['company'] = $request->input('company');
            }
            
            $offset = ($page - 1) * $perPage;
            
            $searchResults = $this->repository->search(
                $filters['ticker'] ?? null, 
                $filters['date'] ?? null, 
                $perPage, 
                $offset
            );
            
            if (!empty($searchResults['data']) && !empty($additionalFilters)) {
                $searchResults['data'] = $this->applyAdditionalFilters(
                    $searchResults['data'], 
                    $additionalFilters,
                    $request
                );
                
                $searchResults['total'] = count($searchResults['data']);
            }
            
            return $searchResults;
        } catch (\Exception $e) {
            \Log::error('Erro ao buscar dados: ' . $e->getMessage());
            
            return [
                'data' => [],
                'total' => 0,
                'page' => $page,
                'limit' => $perPage,
                'error' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Processa os filtros de data da requisição.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    private function processDateFilters(Request $request)
    {
        if ($request->filled('date')) {
            return $request->input('date');
        }
        
        if ($request->filled('start_date')) {
            return $request->input('start_date');
        }
        
        return null;
    }
    
    /**
     * Aplica filtros adicionais aos resultados da consulta.
     *
     * @param  array  $data
     * @param  array  $filters
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function applyAdditionalFilters($data, $filters, $request)
    {
        return collect($data)
            ->filter(function ($item) use ($filters, $request) {
                $matches = true;
                
                if (isset($filters['market']) && !empty($item['MktNm'])) {
                    $matches = $matches && stripos($item['MktNm'], $filters['market']) !== false;
                }
                
                if (isset($filters['category']) && !empty($item['SctyCtgyNm'])) {
                    $matches = $matches && stripos($item['SctyCtgyNm'], $filters['category']) !== false;
                }
                
                if (isset($filters['isin']) && !empty($item['ISIN'])) {
                    $matches = $matches && stripos($item['ISIN'], $filters['isin']) !== false;
                }
                
                if (isset($filters['company']) && !empty($item['CrpnNm'])) {
                    $matches = $matches && stripos($item['CrpnNm'], $filters['company']) !== false;
                }
                
                if ($request->filled('end_date') && !empty($item['RptDt'])) {
                    $matches = $matches && $item['RptDt'] <= $request->input('end_date');
                }
                
                return $matches;
            })
            ->values()
            ->all();
    }
}