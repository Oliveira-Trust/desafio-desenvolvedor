<?php

namespace App\Policies;

use App\Models\CurrencyHistoric;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CurrencyHistoricPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CurrencyHistoric $currencyHistoric): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CurrencyHistoric $currencyHistoric): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CurrencyHistoric $currencyHistoric): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CurrencyHistoric $currencyHistoric): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CurrencyHistoric $currencyHistoric): bool
    {
        //
    }
}
