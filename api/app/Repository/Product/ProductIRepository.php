<?php

namespace App\Repository\Product;

interface ProductIRepository {
    /**
     * this function will be used for create new product
     *
     * @param ProductDTO $product
     * @return array
     */
    public function create(ProductDTO $product): array;

    /**
     * this function is for read one product list
     *
     * @param integer $id
     * @return array
     */
    public function read(int $id) : array;

    /**
     * this function is for read all product list data
     *
     * @return array
     */
    public function readArray(array $ids): array;

    /**
     * this function is for read on product list data without relationships
     *
     * @return array
     */
    public function readClean(int $id): array;

    /**
     * this function is for read all product list data
     *
     * @return array
     */
    public function readAll(): array;

    /**
     * this function will be used for update an existing product
     *
     * @param integer $id
     * @param ProductDTO $product
     * @return array
     */
    public function update(int $id, ProductDTO $product) : array;

    /**
     * this function will delete an existing product
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id) : bool;
}