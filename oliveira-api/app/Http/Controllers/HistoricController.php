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
        $t = $this->historicService->getAll();
        return $t;
    }

    public function listAllHistoricByUser(int $userId)
    {
        $t = $this->historicService->listAllHistoricByUser($userId);
        return $t;
    }
}
