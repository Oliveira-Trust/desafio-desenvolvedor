<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $logs = Logs::all();
        return view('logs.index', compact('logs'));
    }
}
