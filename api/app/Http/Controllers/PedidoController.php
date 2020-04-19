<?php

namespace App\Http\Controllers;

use App\Repositories\PedidoRepository;
use Illuminate\Http\Request;

class PedidoController extends Controller
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
        return PedidoRepository::search($request);
    }

    public function show($id)
    {

        return PedidoRepository::get($id);
    }

    public function store(Request $request)
    {
        return PedidoRepository::save($request->input());
    }

    public function update(Request $request, $id)
    {
        $req = $request->all() + ['id'=>$id];
        return PedidoRepository::save($req);
    }

    public function destroy($id)
    {
        return PedidoRepository::delete($id);
    }

    public function destroyMany(Request $request)
    {
        return PedidoRepository::deleteMany($request);
    }
}
