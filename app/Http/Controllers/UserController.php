<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return view('user.index')->with(['users'=>$users]);
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('user.change');
    }

    public function passwordChange(Request $request, User $user)
    {
        $validatorRules = [
            'password' => 'required|string|min:8|confirmed',
            'password_old' => 'required|string|min:8'
        ];
        $request->validate($validatorRules);
        if(Hash::check($request->password_old,$user->password)){
            $user->update(['password'=>Hash::make($request->password)]);
        }else{
            return redirect()->route('password')->with(['status'=>'Senha antiga inválida!']);
        }
        return redirect()->route('home')->with(['status'=>'Senha alterada com sucesso!']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatorRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ];

        $request->validate($validatorRules);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.index')->with(['status'=>'sucesso']);
    }
    /**
     * Display the specified resource.
     *
     * @param User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show')->with(['user'=>$user]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with(['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $validatorRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ];
        if ($request->input('email') == $user->email) {
            unset($validatorRules['email']);
        }
        $request->validate($validatorRules);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->route('user.index')->with(['status'=>'Usuário alterado com sucesso!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->ids;
        if(in_array(auth()->id(),$ids)){
            return response()->json(['status'=>"você não pode se deletar"]);
        }else{
            foreach ($ids as $id){
                $user = User::find($id);
                if($user){
                    $user->delete();
                }
            }
        }
        return response()->json(['status'=>"usuário(s) deletado(s) com sucesso!"]);

    }
}
