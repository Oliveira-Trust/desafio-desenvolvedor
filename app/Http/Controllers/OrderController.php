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

    public function formDetail($idOrder)
    {
        return view('order.detail', compact("idOrder"));
    }

    public function formEdit($order_id)
    {
        return view('order.edit', compact("order_id"));
    }
}
