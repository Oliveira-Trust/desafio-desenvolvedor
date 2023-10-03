<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
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
        return $user->hasPermission('viewAny_posts');
    }

    public function view(User $user)
    {
        return $user->hasPermission('view_posts');
    }

    public function create(User $user)
    {
        return $user->hasPermission('add_posts');
    }

    public function update(User $user)
    {
        return $user->hasPermission('edit_posts');
    }

    public function delete(User $user)
    {
        return $user->hasPermission('delete_posts');
    }
}
