<?php

namespace App\Http\Controllers;

use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
        return ClienteRepository::search($request);
    }

    public function store(Request $request)
    {
        return ClienteRepository::save($request->input());
    }

    public function show($id)
    {
        return ClienteRepository::get($id);
    }

    public function update(Request $request, $id)
    {
        $req = $request->all() + ['id'=>$id];
        return ClienteRepository::save($req);
    }

    public function destroy($id)
    {
        return ClienteRepository::delete($id);
    }

    public function destroyMany(Request $request)
    {
        return ClienteRepository::deleteMany($request);
    }
}
