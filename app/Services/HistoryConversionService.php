<?php

namespace App\Services;
use App\Repositories\HistoryConversionRepository;
use Illuminate\Support\Facades\Auth;

class HistoryConversionService
{
    private $historyConversionRepository;

    public function __construct()
    {
        $this->historyConversionRepository = new HistoryConversionRepository();
    }

    public function getByUser()
    {
        return $this->historyConversionRepository->findAllByUser(Auth::user()->id);
    }

    public function getAll()
    {
        return $this->historyConversionRepository->findAll();
    }
    public function create($historyConversion)
    {
        return $this->historyConversionRepository->create($historyConversion);
    }
}
