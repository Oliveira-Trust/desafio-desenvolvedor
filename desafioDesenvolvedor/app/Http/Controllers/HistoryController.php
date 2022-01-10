<?php

namespace App\Http\Controllers;

use App\QuotationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stockHistory = QuotationHistory::where('fk_user', $user->id)->get();

        return view('history', [
            'stockHistory' => $stockHistory
        ]);
    }
}
