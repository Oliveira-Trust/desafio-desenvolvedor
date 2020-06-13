<?php

namespace App\Repository;

use Illuminate\Validation\Rule;

class ProductRepository extends AbstractRepository
{
    public function validationUpdate($request, $id) {
        return $request->validate([
            'title'   =>[
                "required",
                "max:60",
                Rule::unique("products")->ignore($id),
            ],
            'description'   => ['required', 'string', 'min:10', 'max:150'],
            'price'         => ['required', 'numeric'],
        ]);
    }
}
