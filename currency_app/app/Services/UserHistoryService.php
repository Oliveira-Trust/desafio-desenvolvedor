<?php

namespace App\Services;

use App\Events\ExchangeCreated;
use App\Models\User;
use App\Models\UserHistory;

class UserHistoryService
{
    /**
     * Função responsável por carregar histórico do usuário
     *
     * @param User $user
     * @return mixed
     */
    public function getHistory(User $user)
    {
        return $user->histories;
    }

    /**
     * Função responsável por registrar conversão
     *
     * @param UserHistory $user_history
     * @return UserHistory
     */
    public function saveHistory(UserHistory $user_history) : UserHistory
    {
        $user_history->user()->associate(auth()->user());
        $user_history->save();

        // DISPARAR EMAIL
        event(new ExchangeCreated($user_history));

        return $user_history;
    }
}
