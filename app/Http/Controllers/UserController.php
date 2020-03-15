<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function index(Request $request)
    {

        if(auth()->user()->access == 'USER')
            return redirect()->route('home');

        $users = User::where('id', '!=', auth()->user()->id)->get();

        $filtros = [
            'name'      => '',
            'email'     => '',
            'access'    => '',
            'order'     => ''
        ];

        if($data = $request->all()){

            $users = User::where('id', '!=', auth()->user()->id);

            if($data['name']){
                $filtros['name'] = $data['name'];
                $data['name'] = '%' . $data['name'] . '%';
                $users = $users->where('name', 'like', $data['name']);
            }

            if($data['email']){
                $filtros['email'] = $data['email'];
                $data['email'] = '%' . $data['email'] . '%';
                $users = $users->where('email', 'like', $data['email']);
            }

            if($data['access']){
                $filtros['access'] = $data['access'];
                $users = $users->where('access', '=', $data['access']);
            }


            if($data['order']){
                $filtros['order'] = $data['order'];
                $users = $users->orderBy($data['order'], 'desc')->get();
            }

        }

        return view('user.home', [
            'users' => $users,
            'filters' => $filtros
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->access == 'USER')
            return redirect()->route('home');

        return view('user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->access == 'USER')
            return redirect()->route('home');

        $data = $request->all();

        if($data['password'] != $data['password_confirmation']){
            return redirect()->route('user.add')->with('danger', 'Senhas Diferentes');
        }

        $data['password'] = Hash::make($data['password']);

        $user = new User;
        $user->create($data);

        return redirect()->route('user.index')->with('success', 'Usuário Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->access == 'USER')
            return redirect()->route('home');

        $user = User::find($id);
        return view('user.user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->access == 'USER')
            return redirect()->route('home');

        $user = User::find($id);
        return view('user.edit', compact('user'));
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
        if(auth()->user()->access == 'USER')
            return redirect()->route('home');

        $data = $request->all();

        if(!empty($data['password']) && !empty($data['password_confirmation'])){
            if($data['password'] != $data['password_confirmation'])
                return redirect()->route('user.edit', $id)->with('danger', 'Senhas diferentes!');

            $data['password'] = Hash::make($data['password']);
        }else{
            unset($data['password']);
        }

        $user = User::find($id);

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Usuário Alterado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->access == 'USER')
            return redirect()->route('home');

        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuário deletado com sucesso!');
    }

    public function me()
    {
        $user = auth()->user();
        return view('user.me', compact('user'));
    }

    public function meUpdate(Request $request)
    {
        $user = auth()->user();

        $data = $request->all();

        if(!empty($data['password'])){

            if($data['password_confirm'] != $data['password']){
                return redirect()->route('user.me')->with('danger', 'Senhas diferentes');
            }

            $data['password'] = Hash::make($data['password']);

        }else{
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.me')->with('success', 'Editado com sucesso!');
    }

    public function meDelete(Request $request)
    {
        $user = auth()->user();
        $user->delete();
        return redirect()->route('logout');
    }

}
