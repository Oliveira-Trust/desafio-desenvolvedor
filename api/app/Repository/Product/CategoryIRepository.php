<?php

namespace App\Repository\Product;

interface CategoryIRepository {
    /**
     * this function will be used for create new category
     *
     * @param CategoryDTO $category
     * @return array
     */
    public function create(CategoryDTO $category): array;

    /**
     * this function is for read one category list
     *
     * @param integer $id
     * @return array
     */
    public function read(int $id) : array;

    /**
     * this function is for read all category list data
     *
     * @return array
     */
    public function readAll(): array;

    /**
     * this function will be used for update an existing category
     *
     * @param integer $id
     * @param CategoryDTO $category
     * @return array
     */
    public function update(int $id, CategoryDTO $category) : array;

    /**
     * this function will delete an existing category
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id) : bool;
}