<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserHistory;

class UserHistoryService
{
    public function getHistory(User $user)
    {
        return $user->histories;
    }


    public function saveHistory(UserHistory $user_history)
    {
        $user_history->user()->associate(auth()->user());
        $user_history->save();

        // TODO: DISPARAR EMAIL

        return $user_history;
    }
}
