<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Support\Arr;
use DataTables;

class UserController extends Controller
{


    function __construct()
    {
        $this->middleware('role:User view', ['only' => ['index','show', 'DataTable']]);
        $this->middleware('role:User create', ['only' => ['create','store']]);
        $this->middleware('role:User edit', ['only' => ['edit','update']]);
        $this->middleware('role:User delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User/Index');

    }

    
    public function DataTable()
    {

      $Data = User::select('id', 'name', 'email', 'username');
      return  Datatables::of($Data)->make();

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Roles      = User::RoleList();
        return view('User.Create',compact('Roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {



        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return view('User/Index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Dados      = User::findOrFail($id);
        $Roles      = User::RoleList();
        $UserRole   = $Dados->roles->pluck('name','id')->all();
        return view('User.View',compact('Dados','Roles','UserRole'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Dados = User::find($id);
        $Roles      = User::RoleList();
        $UserRole = $Dados->roles->pluck('name','name')->all();

        return view('User.Edit',compact('Dados','Roles','UserRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $user = User::find($id);
        $user->update($input);


        $user->syncRoles($request->input('roles'));



        return view('User/Index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return view('User/Index');
    }




}
