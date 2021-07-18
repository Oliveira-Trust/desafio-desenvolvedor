<?php

namespace App\Repository\Product\implementations;

use App\Repository\Product\ProductIRepository;
use App\Repository\Product\ProductDTO;
use App\Models\Product\Product;

class ProductRepository implements ProductIRepository {

    public function create(ProductDTO $productDTO): array {
        $product = new Product($productDTO->toArray());
        $product->save();
        return $product->toArray();
    }

    public function read(int $id): array {
        try {
            return Product::with('category')->findOrFail($id)->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function readArray(array $ids): array {
        try {
            return Product::with('category')
                ->whereIn('id', $ids)
                ->get()
                ->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function readAll(): array {
        return Product::with('category')->get()->toArray();
    }

    public function update(int $id, ProductDTO $productDTO) : array {
        $product = Product::find($id);
        $product->fill($productDTO->toArray());
        $product->save();
        return $product->toArray();
    }

    public function delete(int $id) : bool {
        return Product::destroy($id);
    }
}