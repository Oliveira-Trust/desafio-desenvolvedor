<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function formView()
    {
        return view('order.view');
    }

    public function formCreate()
    {
        return view('order.create');
    }
}
