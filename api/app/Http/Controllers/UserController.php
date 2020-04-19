<?php

namespace App\Http\Controllers;

use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
    * Instantiate a new UserController instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
