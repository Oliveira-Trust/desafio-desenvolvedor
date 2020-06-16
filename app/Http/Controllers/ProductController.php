<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function formView()
    {
        return view('product.view');
    }

    public function formEdit($product_id)
    {
        return view('product.edit', compact("product_id"));
    }

    public function formCreate()
    {
        return view('product.create');
    }
}
