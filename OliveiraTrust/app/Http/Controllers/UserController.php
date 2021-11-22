<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    private $model;

    function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index()
    {
        return redirect('index');
        //return view('user/index')->with('users',$this->model->where(['status' => 1])->paginate(10));
    }

    public function show()
    {
        return view('user/show');
    }

    public function create(CreateUserRequest $request)
    {
        $this->model->create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
        ]);

        session()->flash('msg', 'O usuário foi cadastrado com sucesso!');

        return redirect()->route('login');
    }

    public function update(UpdateUserRequest $request)
    {
        $this->model->where(['email' => Auth::user()->email])->update($request->except('_token'));

        session()->flash('msg', 'O usuário foi atualizado com sucesso!');

        return redirect()->route('index.url');
    }

    public function edit(Request $request)
    {
        return view('user/edit')->with('user', $this->model->findOrFail(Auth::user()->id));
    }

    public function delete(Request $request)
    {
        $this->model->where(['id' => $request->id])->delete();

        return true;
    }
}
