<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{
    public function index()
    {
        $logs = Logs::where('user_id', Auth::user()->id)->get();
        return view('logs.index', compact('logs'));
    }
}
