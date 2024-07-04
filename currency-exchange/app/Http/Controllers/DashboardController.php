<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversion;

class DashboardController extends Controller
{
    public function index()
    {
        $conversions = Conversion::all();
        return view('dashboard', ['conversion' => $conversions]);
    }
}
