<?php

namespace App\Repository\Product;

use App\Repository\AbstractDataTransferObject;
use App\Repository\Product\CategoryDTO;
class ProductDTO extends AbstractDataTransferObject {
    private ?int $id = 0;
    public ?string $name = null;
    public ?int $category_id = null;
    public ?string $description = null;
    public ?string $color = null;
    public ?float $size = null;
    public ?float $price = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules() {
        return [
            'name' => 'required|string|unique:products',
            'category_id' => 'required|exists:categories,id',
            'description' => 'string',
            'color' => 'string',
            'size' => 'numeric',
            'price' => 'numeric'
        ];
    }
    public static function rulesUpdate(int $id) {
        return [
            'name' => 'string|unique:products, "name", '.$id,
            'category_id' => 'exists:categories,id',
            'description' => 'string',
            'color' => 'string',
            'size' => 'numeric',
            'price' => 'numeric'
        ];
    }
}