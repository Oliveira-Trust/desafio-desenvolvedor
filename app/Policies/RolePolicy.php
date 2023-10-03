<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
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
        return $user->hasPermission('viewAny_roles');
    }

    public function view(User $user)
    {
        return $user->hasPermission('view_roles');
    }

    public function create(User $user)
    {
        return $user->hasPermission('add_roles');
    }

    public function update(User $user)
    {
        return $user->hasPermission('edit_roles');
    }

    public function delete(User $user)
    {
        return $user->hasPermission('delete_roles');
    }
}
