<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ClienteController extends Controller
{

    public function index()
    {
        return User::all();

        return response()->json();
    }

    public function store(Request $req)
    {
        User::create($req->all());
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $req, $id)
    {
        $cliente = User::findOrFail($id);
        $cliente->update($req->all());
    }

    public function destroy($id)
    {
        $cliente = User::findOrFail($id);
        $cliente->delete();
    }
}
