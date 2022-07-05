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
}
