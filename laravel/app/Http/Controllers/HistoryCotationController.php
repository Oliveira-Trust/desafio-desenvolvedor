<?php

namespace App\Http\Controllers;

use App\Http\Services\HistoryCotationService;
use Illuminate\Http\Request;

class HistoryCotationController extends Controller
{
    public function history()
    {
        $history = (new HistoryCotationService())->getHistory();

        return view('history-cotation.history', ['history' => $history]);
    }

    public function show($id)
    {
        $history = (new HistoryCotationService())->findById($id);

        return view('history-cotation.show', ['history' => $history]);
    }
}
