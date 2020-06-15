<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formView()
    {
        $listUsers = User::all();
        return view('client.view', compact('listUsers'));
    }
}
