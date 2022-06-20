<?php

namespace Oliveiratrust\Fee;

use Illuminate\Auth\Access\HandlesAuthorization;
use Oliveiratrust\Models\User\User;

class FeePolicy {

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update($user, $model)
    {
        return $user->is_admin;
    }

    public function destroy($user, $model)
    {
        return $user->is_admin;
    }
}
