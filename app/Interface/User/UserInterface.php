<?php

namespace App\Interface\User;

/**
 * Interface for the Quote Service.
 */
interface UserInterface
{
    public function getUserById(int $id);
    public function update(int $id, array $data);
    public function getUserConfigTax(int $id, string $method);
    public function updateUserConfigTax(int $id, array $data);
    public function getHistoricalQuotesByUserId(string $userId);
}