<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\HistoryServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class HistoryController extends Controller
{
    private HistoryServices $historyServices;

    public function __construct(HistoryServices $historyServices)
    {
        $this->historyServices = $historyServices;
    }

    public function index(): JsonResponse
    {
        return response()->json(
            $this->historyServices->getAll()->first(),
            Response::HTTP_OK
        );
    }
}
