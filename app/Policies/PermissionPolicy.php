<?php

namespace App\Policies;

use App\Models\User;

class PermissionPolicy
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
        return $user->hasPermission('viewAny_permissions');
    }

    public function view(User $user)
    {
        return $user->hasPermission('view_permissions');
    }

    public function create(User $user)
    {
        return $user->hasPermission('add_permissions');
    }

    public function update(User $user)
    {
        return $user->hasPermission('edit_permissions');
    }

    public function delete(User $user)
    {
        return $user->hasPermission('delete_permissions');
    }
}
