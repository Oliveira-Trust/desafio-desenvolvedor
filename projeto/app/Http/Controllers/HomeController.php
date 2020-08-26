<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

	// Página inicial.
    public function index()
    {
        return view('home');
    }
}
