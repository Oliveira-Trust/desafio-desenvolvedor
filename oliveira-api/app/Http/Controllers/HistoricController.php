<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HistoricService;

class HistoricController extends Controller
{
    private $historicService;

    public function __construct(HistoricService $historicService)
    {
        $this->historicService = $historicService;
    }

    public function listAllHistorics()
    {
        return $this->historicService->getAll();
    }

    public function listAllHistoricByUser(int $userId)
    {
        return $this->historicService->listAllHistoricByUser($userId);
    }
}
