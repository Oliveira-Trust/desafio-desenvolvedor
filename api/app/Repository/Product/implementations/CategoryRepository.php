<?php

namespace App\Repository\Product\implementations;

use App\Repository\Product\CategoryIRepository;
use App\Repository\Product\CategoryDTO;
use App\Models\Product\Category;

class CategoryRepository implements CategoryIRepository {

    public function create(CategoryDTO $categoryDTO): array {
        $category = new Category($categoryDTO->toArray());
        $category->save();
        return $category->toArray();
    }

    public function read(int $id): array {
        try {
            return Category::findOrFail($id)->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function readAll(): array {
        return Category::all()->toArray();
    }

    public function update(int $id, CategoryDTO $categoryDTO) : array {
        $category = Category::find($id);
        $category->fill($categoryDTO->toArray());
        $category->save();
        return $category->toArray();
    }

    public function delete(int $id) : bool {
        return Category::destroy($id);
    }
}