<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends AbstractController
{
    /**
    * Define the Model for abstract Controller
    */
    protected function getModel()
    {
        return Product::class;
    }

    /**
    * Validate the request for abstract Controller
    */
    protected function modelValidation(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'price' => 'required|numeric',
            'available_quantity' => 'required|numeric',
        ],
        [
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Nome é muito grande',
            'price.required' => 'Preço é obrigatório',
            'price.numeric' => 'Preço inválido',
            'available_quantity.required' => 'A quantidade disponível é obrigatória',
        ]);
    }
}
