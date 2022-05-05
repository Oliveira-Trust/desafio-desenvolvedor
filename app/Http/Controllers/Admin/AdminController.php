<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exchange;
use Illuminate\Http\Request;

class AdminController extends Controller
{    
    public function index(){
        return view('admin.index');
    }

    public function exchanges(){
        return view('admin.exchanges')->with('exchanges', Exchange::all());
    }

}
