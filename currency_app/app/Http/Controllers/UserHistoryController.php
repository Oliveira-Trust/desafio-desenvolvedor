<?php

namespace App\Http\Controllers;

use App\Services\UserHistoryService;

class UserHistoryController extends Controller
{

    /**
     * Exibe o histórico de conversões do usuário logado
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(UserHistoryService $user_history_service)
    {
        return view('user-history.index', [
            'histories' => $user_history_service->getHistory(auth()->user())
        ]);
    }
}
