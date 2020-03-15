<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth('api')->user()->access == 'USER')
            return response()->json(['error' => 'Você não tem permissão']);

        $users = User::where('id', '!=', auth('api')->user()->id)->get();

        if($data = $request->all()){

            $users = User::where('id', '!=', auth()->user()->id);

            if($data['name']){
                $data['name'] = '%' . $data['name'] . '%';
                $users = $users->where('name', 'like', $data['name']);
            }

            if($data['email']){
                $data['email'] = '%' . $data['email'] . '%';
                $users = $users->where('email', 'like', $data['email']);
            }

            if($data['access']){
                $users = $users->where('access', '=', $data['access']);
            }


            if($data['order']){
                $users = $users->orderBy($data['order'], 'desc')->get();
            }

        }

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth('api')->user()->access == 'USER')
            return redirect()->route('home');

        $data = $request->all();

        if($data['password'] != $data['password_confirmation']){
            return response()->json(['error' => 'Senhas Diferentes']);
        }

        $data['password'] = Hash::make($data['password']);

        $user = new User;
        $user = $user->create($data);

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth('api')->user()->access == 'USER')
            return redirect()->route('home');

        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth('api')->user()->access == 'USER')
            return response()->json(['error' => 'Você não tem permissão']);

        $data = $request->all();

        if(!empty($data['password']) && !empty($data['password_confirmation'])){
            if($data['password'] != $data['password_confirmation'])
                return response()->json(['error' => 'Senhas diferentes!']);

            $data['password'] = Hash::make($data['password']);
        }else{
            unset($data['password']);
        }

        $user = User::find($id);

        $user->update($data);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth('api')->user()->access == 'USER')
            return response()->json(['error' => 'Você não tem permissão']);

        $user = User::find($id);
        $user->delete();

        return response()->json();
    }

    public function me()
    {
        $user = auth('api')->user();
        return response()->json($user);
    }

    public function meUpdate(Request $request)
    {
        $user = auth('api')->user();

        $data = $request->all();

        if(!empty($data['password'])){

            if($data['password_confirm'] != $data['password']){
                return response()->json(['error' => 'Senhas diferentes']);
            }

            $data['password'] = Hash::make($data['password']);

        }else{
            unset($data['password']);
        }

        $user->update($data);

        return response()->json($user);
    }

    public function meDelete(Request $request)
    {
        $user = auth('api')->user();
        $user->delete();
        auth('api')->logout();
        return response()->json();
    }

}
