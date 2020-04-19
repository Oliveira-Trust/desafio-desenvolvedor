<?php

namespace App\Http\Controllers;

use App\Repositories\StatusRepository;
use Illuminate\Http\Request;

class StatusController extends Controller
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

    public function index(Request $request)
    {
        return StatusRepository::search($request);
    }
}
