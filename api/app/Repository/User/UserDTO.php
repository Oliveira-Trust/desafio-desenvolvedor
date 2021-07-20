<?php

namespace App\Repository\User;

use App\Repository\AbstractDataTransferObject;

class UserDTO extends AbstractDataTransferObject {
    private ?int $id = 0;
    public ?string $name = null;
    public ?string $username = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $type = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules() {
        return [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|confirmed'
        ];
    }

    public static function rulesLogin() {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }
}