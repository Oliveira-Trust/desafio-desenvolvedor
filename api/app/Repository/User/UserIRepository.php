<?php

namespace App\Repository\User;

interface UserIRepository {

    /**
     * this function will be used for create new User
     *
     * @param UserDTO $user
     * @return bool
     */
    public function create(UserDTO $user): bool;

    /**
     * this function is for read one user list
     *
     * @param integer $id
     * @return UserDTO
     */
    public function read(int $id) : array;

    /**
     * this function is for read all User list data
     *
     * @return array
     */
    public function readAll(): array;

    /**
     * this function will be used for update an existing User
     *
     * @param integer $id
     * @param UserDTO $user
     * @return bool
     */
    public function update(int $id, UserDTO $user) : bool;

    /**
     * this function will delete an existing User
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id) : bool;
}