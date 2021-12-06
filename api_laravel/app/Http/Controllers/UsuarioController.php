<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Usuario;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;



class UsuarioController extends Controller
{

    public $user;

    public function __construct(User $user) 
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  $this->user->all();

        return response()->json($users, 200);
    }

    public function form() 
    {
        return view('app.cadastro');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "Chegamos ate aqui";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate($this->user->rules(), $this->user->messagesInfo());

        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => $request->password
            'password' => Hash::make($request->password)
        ]);

        $user->save();

        return response()->json($user, 201);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
