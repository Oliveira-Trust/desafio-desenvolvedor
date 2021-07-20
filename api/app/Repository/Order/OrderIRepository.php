<?php

namespace App\Repository\Order;

interface OrderIRepository {
    /**
     * this function will be used for create new order
     *
     * @param OrderDTO $order
     * @return array
     */
    public function create(OrderDTO $order): array;

    /**
     * this function is for read one order list
     *
     * @param integer $id
     * @return array
     */
    public function read(int $id) : array;

    /**
     * this function is for read one order list whithout relationships
     *
     * @param integer $id
     * @return array
     */
    public function readClean(int $id) : array;

    /**
     * this function is for read one order list
     *
     * @param integer $id
     * @return array
     */
    public function readArray(array $ids) : array;

    /**
     * this function is for read all order list data
     *
     * @return array
     */
    public function readAll(): array;

    /**
     * this function will be used for update an existing order
     *
     * @param integer $id
     * @param OrderDTO $order
     * @return array
     */
    public function update(int $id, OrderDTO $order) : array;

    /**
     * this function will delete an existing order
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id) : bool;
}