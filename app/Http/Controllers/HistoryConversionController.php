<?php

namespace App\Http\Controllers;

use App\Services\HistoryConversionService;

class HistoryConversionController extends Controller
{
    //
    private $historyConversionService;

    public function __construct() {
        $this->historyConversionService = new HistoryConversionService();
    }

    public function index() {
        return $this->historyConversionService->getAll();
    }
}
