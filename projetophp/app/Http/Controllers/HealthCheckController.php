<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'OK']);
    }
}
