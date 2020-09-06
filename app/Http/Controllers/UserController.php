<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userList = User::paginate(5);

        $viewData = [
            'userList' => $userList,
        ];

        return view('dashboard.users.list', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:users,name'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string'],
            'image' => ['image', 'mimes:png,jpg'],
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        if ($request->hasFile('image')) {

            $image = $request->file('image')->store('avatars');
        } else {
            $image = 'https://via.placeholder.com/100';
        }

        $newUser = new User;

        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $password;
        $newUser->avatar = $image;

        $newUser->save();

        return redirect()->route('users.index')->with('success', 'Usuário adicionado com sucesso !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $viewData = ['user' => $user];

        if ($user) {
            return view('dashboard.users.show', $viewData);
        } else {
            return redirect()->route('users.index')->with('error', 'Usuário não encontrado !');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $viewData = ['user' => $user];

        if ($user) {
            return view('dashboard.users.edit', $viewData);
        } else {
            return redirect()->route('users.index')->with('error', 'Usuário não encontrado !');
        }
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
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string'],
            'image' => ['image', 'mimes:png,jpg'],
        ]);

        $editedUser = User::find($id);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $image = $editedUser->avatar;

        if ($request->hasFile('image')) {
            $imageExists = Storage::disk('public')->exists($editedUser->avatar);

            if ($imageExists) {
                Storage::disk('public')->delete($editedUser->avatar);
            }
            $image = $request->file('image')->store('avatars');
        }

        $editedUser->name = $name;
        $editedUser->email = $email;
        $editedUser->password = $password;
        $editedUser->avatar = $image;

        $editedUser->save();

        return redirect()->route('users.index')->with('success', 'Usuário editado com sucesso !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findedUser = User::find($id);

        if ($findedUser->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'Você não pode se apagar !');
        }

        if ($findedUser) {
            $imageExists = Storage::disk('public')->exists($findedUser->avatar);
            if ($imageExists) {
                Storage::disk('public')->delete($findedUser->avatar);
            }
            $findedUser->delete();
            return redirect()->route('users.index')->with('success', 'Usuário  removido com sucesso !');
        } else {
            return redirect()->route('users.index')->with('error', 'Não foi possível remover o usuário!');
        }
    }

    public function search()
    {

    }

    public function orders($id)
    {
        $findedUser = User::find($id);

        $viewData = ['user' => $findedUser];

        return view('dashboard.users.orders', $viewData);
    }
}
