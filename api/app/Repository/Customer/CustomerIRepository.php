<?php

namespace App\Repository\Customer;

interface CustomerIRepository {
    /**
     * this function will be used for create new customer
     *
     * @param CustomerDTO $customer
     * @return array
     */
    public function create(CustomerDTO $customer): array;

    /**
     * this function is for read one customer list
     *
     * @param integer $id
     * @return array
     */
    public function read(int $id) : array;

    /**
     * this function is for read all customer list data
     *
     * @return array
     */
    public function readAll(): array;

    /**
     * this function will be used for update an existing customer
     *
     * @param integer $id
     * @param CustomerDTO $customer
     * @return array
     */
    public function update(int $id, CustomerDTO $customer) : array;

    /**
     * this function will delete an existing customer
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id) : bool;
}