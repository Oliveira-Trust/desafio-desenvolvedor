<?php

namespace App\Repository\Customer;

use App\Repository\AbstractDataTransferObject;

class CustomerDTO extends AbstractDataTransferObject {
    private ?int $id = 0;
    public ?string $name = null;
    public ?string $email = null;
    public ?string $cpf = null;
    public ?string $phone = null;
    public ?string $address = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules() {
        return [
            'name' => 'required|string',
            'email' => 'string',
            'cpf' => 'required|string|unique:customers',
            'phone' => 'string',
            'address' => 'string'
        ];
    }
    public static function rulesUpdate($id) {
        return [
            'name' => 'string',
            'email' => 'string',
            'cpf' => 'string|unique:customers, "cpf", '.$id,
            'phone' => 'string',
            'address' => 'string'
        ];
    }
}