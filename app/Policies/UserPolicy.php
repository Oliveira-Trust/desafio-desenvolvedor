<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function before(User $user): ?bool
    {
        if ($user->isAdministrator()) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user)
    {
        return $user->hasPermission('viewAny_users');
    }

    public function view(User $user)
    {
        return $user->hasPermission('view_users');
    }

    public function create(User $user)
    {
        return $user->hasPermission('add_users');
    }

    public function update(User $user)
    {
        return $user->hasPermission('edit_users');
    }

    public function delete(User $user)
    {
        return $user->hasPermission('delete_users');
    }
}
