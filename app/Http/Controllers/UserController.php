<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Crypt;

use App\Models\User;

class UserController extends Controller
{
    public function list($order_by='created_at') {
        $direction = 'desc';
        $user = User::orderBy($order_by, $direction)->paginate(10);
        $lenght = count($user);

        if($lenght == 0) return abort(204);

        return $user;
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return $user;
    }

    public function store(Request $request){
        try {

            // A string está em uma variável do .env, porém não consehui utilizá-la aqui
            $password = $request->password.'f475e39ecb9a30f279c9c9e3f78edd1c';
            $token_password = md5($password);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $token_password,
            ]);
            return response()->json(['user' => $user], 201);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function update(Request $request, $id){
        try {
            $user = User::where('id', $id)->update($request->all());

            if($user) return ['user' => $id];

            return abort(404);

        } catch(\Exception $error) {
            return Response::json([
                'Response' => $error
            ], 400);
        }
    }

    public function delete($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return ['user deleted with success'];

        } catch(\Exception $error) {
            return ['response' => 'Error', 'details' => $error];
        }
    }
}
