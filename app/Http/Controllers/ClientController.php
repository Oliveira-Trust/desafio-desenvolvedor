<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function formView()
    {
        return view('client.view');
    }

    public function formEdit($user_id)
    {
        return view('client.edit', compact("user_id"));
    }
}
