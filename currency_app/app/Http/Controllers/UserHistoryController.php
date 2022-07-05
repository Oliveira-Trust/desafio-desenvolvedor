<?php

namespace App\Http\Controllers;

use App\Services\UserHistoryService;

class UserHistoryController extends Controller
{

    public function index(UserHistoryService $user_history_service)
    {
        return view('user-history.index', [
            'histories' => $user_history_service->getHistory(auth()->user())
        ]);
    }
}
