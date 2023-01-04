<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConversorRequest;
use Illuminate\Http\Request;

class ConversorController extends Controller
{
    public function conversor(ConversorRequest $request)
    {
        return $request->all();
    }
}
