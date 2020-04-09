<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JWTAuth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['success' => true, 'data' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = new User;
        $user->fill($data);
        $user->save();
        return response()->json(['success' => true, 'data' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       return response()->json(['success' => true, 'data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json(['success' => true, 'data' => $user]);
    }

    /**
     * Update the Authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateAuthenticated(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();
        $user->update($request->all());
        return response()->json(['success' => true, 'data' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'data' => trans('api.user.delete')]);
    }

    /**
     * Store user avatar image.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function avatarUpload(Request $request) 
    {
        $user = JWTAuth::parseToken()->toUser();
        if($request->hasFile('avatar')) {
            if($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $file = Storage::disk('public')->put("images/avatars", $request->avatar);
            $user->update(['avatar' => $file]);
            return response()->json(['sucess' => true, 'data'=> []]);
        } else {
            return response()->json(['sucess' => false, 'data'=> []], 400);
        }
    }
}
