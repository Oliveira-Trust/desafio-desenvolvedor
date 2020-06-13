<?php

namespace App\Repository;

use Illuminate\Validation\Rule;

class UserRepository extends AbstractRepository
{

    public function validationUpdate($request, $id) {
        return $request->validate([
            'name'   =>["required", "max:255", "min:3"],
            "email" => ['required', 'string', 'email', 'max:255', Rule::unique("users")->ignore($id)],
        ]);
    }

}
