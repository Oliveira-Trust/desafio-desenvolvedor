<?php


namespace App\Services;

use App\Repositories\ConversionHistoryRepository;

class ConversionHistoryService
{

    /**
     * @var ConversionHistoryRepository
     */
    protected $conversionHistoryRepository;

    public function __construct(ConversionHistoryRepository $conversionHistoryRepository)
    {
        $this->conversionHistoryRepository = $conversionHistoryRepository;
    }

    /**
     * @return \App\Repositories\ConversionHistoryRepository
    */
    public function repository()
    {
        return $this->conversionHistoryRepository;
    }

    /**
     * Gera o histórico de cotação do usuário autenticado
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function store(array $data)
    {
        return $this->repository()->create($data);
    }


    /**
     * Retorna todas as informações de cotação do usuário autenticado.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all()
    {
        return $this->repository()->findByDataAll()->paginate(5);
    }
}
