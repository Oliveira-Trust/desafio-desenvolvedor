<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function save(array $attributes)
    {
        return $this->productRepository->create($attributes);
    }

    public function update(array $attributes, int $id)
    {
        return $this->productRepository->update($id, $attributes);
    }

    public function destroy(int $id)
    {
        return $this->productRepository->destroy($id);
    }

    public function find(int $id)
    {
        return $this->productRepository->find($id);
    }
}
