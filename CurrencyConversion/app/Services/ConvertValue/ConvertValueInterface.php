<?php

namespace App\Services\ConvertValue;

use App\Models\CurrencyConversion;
use App\Models\User;
use App\Repositories\Contracts\ConvertedValueRepository;

interface ConvertValueInterface
{
    /**
     * Set parameters.
     *
     * @param array $params
     * @return ConvertValueInterface
     */
    public function setParams(array $params) : ConvertValueInterface;


    /**
     * Set a Id.
     *
     * @param User $Id
     * @return ConvertValueInterface
     */
    public function setId(int $id) : ConvertValueInterface;


    /**
     * Set a User.
     *
     * @param User $User
     * @return ConvertValueInterface
     */
    public function setUser(User $User) : ConvertValueInterface;

    /**
     * Set repository Convert Value.
     *
     * @param ConvertedValueRepository $ConvertedValueRepository
     * @return ConvertValueInterface
     */
    public function setConvertValueRepository(ConvertedValueRepository $ConvertedValueRepository): ConvertValueInterface;

    /**
     * Handle.
     *
     * @return CurrencyConversion|null
     */
    public function handle() :? CurrencyConversion;
}
