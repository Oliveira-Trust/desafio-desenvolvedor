<?php

namespace App\Repository\Customer\implementations;

use App\Repository\Customer\CustomerIRepository;
use App\Repository\Customer\CustomerDTO;
use App\Models\Customer;

class CustomerRepository implements CustomerIRepository {

    public function create(CustomerDTO $customerDTO): array {
        $customer = new Customer($customerDTO->toArray());
        $customer->save();
        return $customer->toArray();
    }

    public function read(int $id): array {
        try {
            return Customer::findOrFail($id)->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function readAll(): array {
        return Customer::all()->toArray();
    }

    public function update(int $id, CustomerDTO $customerDTO) : array {
        $customer = Customer::find($id);
        $customer->fill($customerDTO->toArray());
        $customer->save();
        return $customer->toArray();
    }

    public function delete(int $id) : bool {
        return Customer::destroy($id);
    }
}