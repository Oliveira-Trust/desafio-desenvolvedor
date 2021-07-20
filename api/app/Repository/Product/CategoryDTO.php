<?php

namespace App\Repository\Product;

use App\Repository\AbstractDataTransferObject;

class CategoryDTO extends AbstractDataTransferObject {
    private ?int $id = 0;
    public ?string $name = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules() {
        return [
            'name' => 'required|string|unique:categories'
        ];
    }
    public static function rulesUpdate(int $id) {
        return [
            'name' => 'string|unique:categories, "name", '.$id
        ];
    }
}