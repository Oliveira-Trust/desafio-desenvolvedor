<?php

namespace Oliveiratrust\Quotation;

use Illuminate\Auth\Access\HandlesAuthorization;
use Oliveiratrust\Models\User\User;

class QuotationPolicy {

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

    public function show($user, $model)
    {
        if ($user->is_admin) {
            return true;
        }

        return $user->id === $model->user_id;
    }
}
